<?php

namespace App\Usecases\Csv;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Http\Request;

class UploadUsecase
{
    public function run(Request $request)
    {
        $post = new Post();
        // CSVファイルが存在するかの確認
        if ($request->hasFile('csvFile')) {
            //拡張子がCSVであるかの確認
            if ($request->csvFile->getClientOriginalExtension() !== "csv") {
                throw new Exception('不適切な拡張子です。');
            }
            //ファイルの保存
            $newCsvFileName = $request->csvFile->getClientOriginalName();
            $request->csvFile->storeAs('public/csv', $newCsvFileName);
        } else {
            throw new Exception('CSVファイルの取得に失敗しました。');
        }
        //保存したCSVファイルの取得
        $csv = Storage::disk('local')->get("public/csv/{$newCsvFileName}");
        // OS間やファイルで違う改行コードをexplode統一
        $csv = str_replace(array("\r\n", "\r"), "\n", $csv);
        // $csvを元に行単位のコレクション作成。explodeで改行ごとに分解
        $uploadedData = collect(explode("\n", $csv));

        // テーブルとCSVファイルのヘッダーの比較
        $header = collect($post->csvHeader());
        $uploadedHeader = collect(explode(",", $uploadedData->shift()));
        if ($header->count() !== $uploadedHeader->count()) {
            throw new Exception('Error:ヘッダーが一致しません');
        }

        // 連想配列のコレクションを作成
        //combine 一方の配列をキー、もう一方を値として一つの配列生成。haederをキーとして、一つ一つの$oneRecordと組み合わせて、連想配列のコレクション作成
        try {
            $posts = $uploadedData->map(fn($oneRecord) => $header->combine(collect(explode(",", $oneRecord))));
        } catch (Exception $e) {
            throw new Exception('Error:ヘッダーが一致しません');
        }

        // $postsコレクションを配列にして、一括挿入
        DB::table('posts')->insert($posts->toArray());
    }
}
