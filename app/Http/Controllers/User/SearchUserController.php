<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SearchUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function __invoke(Request $request)
    {
        // クエリから希望職種idのリストを取得
        $desired_occupations_id = $request->query('desired_occupations_id');

        // クエリからフリーワード検索
        $free_word = $request->query('free_word');

        // 古い順
        $older = $request->query('older');

        $users = User::query()->where('privilege', '=', '0');

        // 希望職種からor検索
        if ($desired_occupations_id) {
            $users->whereIn('desired_occupations', $desired_occupations_id);
        }

        // フリーワードで検索
        if ($free_word) {
            //TODO フルネームで検索するように変更
            $users->where(function ($query) use ($free_word) {
                $query->where('last_name', 'like', "%$free_word%")
                    ->orWhere('first_name', 'like', "%$free_word%")
                    // 学籍番号で検索
                    ->orWhere('student_number', 'like', "%$free_word%");
            });
        }

        // 最新順にする処理
        // older（古い順）がtrueなら以下は実行されない
        if ($older == false) {
            $users->orderBy('year_of_graduation', 'desc');
        }

        return $users->paginate(6);
    }
}
