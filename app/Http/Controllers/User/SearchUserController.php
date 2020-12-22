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

        //TODO 卒業年次検索
        $year_of_graduation = $request->query('year_of_graduation');

        // 卒業フラグ
        $graduation = $request->query('graduation') != NULL ? $request->query('graduation') : true;

        $users = User::with('desired_occupation')->where('privilege', '=', '0');

        // 希望職種からor検索
        if ($desired_occupations_id) {
            $users->whereIn('desired_occupations', $desired_occupations_id);
        }

        // 卒業年次検索
        if ($year_of_graduation) {
            $users->whereYear('year_of_graduation', '=', '20' . $year_of_graduation);
        }

        // フリーワードで検索
        if ($free_word) {
            //TODO フルネームで検索するように変更
            $users->where(function ($query) use ($free_word) {
                // 名前検索
                $query->where('last_name', 'like', "%$free_word%")
                    ->orWhere('first_name', 'like', "%$free_word%")
                    // 学籍番号で検索
                    ->orWhere('student_number', 'like', "%$free_word%");
            });
        }

        // 卒業生のみデフォルトはTrue
        if ($graduation) {
            $users->where('year_of_graduation', '>', now());
        }

        // 最新順にする処理
        // older（古い順）がtrueなら以下は実行されない
        if ($older == false) {
            $users->orderBy('year_of_graduation', 'desc');
        }

        return $users->paginate(16);
    }
}
