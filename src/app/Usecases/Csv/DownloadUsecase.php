<?php

namespace App\Usecases\Csv;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadUsecase
{
    public function run(Request $request)
    {
        $post = new Post();
        $response = new StreamedResponse (function () use ($request, $post) {
            $stream = fopen('php://output', 'w');

            //　文字コードを変換して、文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVファイルにヘッダーを追加
            fputcsv($stream, $post->csvHeader());

            //CSVファイルに挿入するデータの取得
            $insertData = $post->getCsvData();

            // データの挿入
            if (empty($insertData[0])) {
                fputcsv($stream, [
                    'データが存在しません。',
                ]);
            } else {
                foreach ($insertData as $row) {
                    // 各列に行を追加（カラムに値）
                    fputcsv($stream, $post->insertRow($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        //filenameは自由に指定可
        $response->headers->set('Content-Disposition', 'attachment; filename="posts.csv"');

        return $response;
    }
}