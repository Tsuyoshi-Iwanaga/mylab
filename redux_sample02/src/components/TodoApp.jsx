import React from 'react';

export default function TodoApp({ task, tasks, inputTask, addTask, data }) {
  return (
    <div>
      <input type="text" onChange={(e)=>inputTask(e.target.value)} />
      <input type="button" value="add" onClick={()=>addTask(task)} />
      <ul>
        {
          tasks.map(function(item, i) {
            return (
              <li key={i}>{item}</li>
            );
          })
        }
      </ul>
      <table border="1">
        <tbody>
          {
            data.map(function(item, i) {
              return (
                <tr key={i}>
                  <th>{item["チェック日"]}</th>
                  <td>{item["時間"]}</td>
                  <td>{item["ASIN"]}</td>
                  <td><a href={item['URL']} target="_blank" rel="noopener">{item["URL"]}</a></td>
                  <td>{item["JAN"]}</td>
                  <td>{item["商品名"]}</td>
                  <td>{item["カテゴリ"]}</td>
                  <td>{item["ブランド"]}</td>
                  <td>{item["在庫 判定"]}</td>
                  <td>{item["在庫 有無"]}</td>
                  <td>{item["在庫 出品者"]}</td>
                  <td>{item["在庫 在庫数"]}</td>
                  <td>{item["在庫 価格"]}</td>
                  <td>{item["在庫 残り点数（数）"]}</td>
                  <td>{item["売価 判定"]}</td>
                  <td>{item["売価 DB 売価"]}</td>
                  <td>{item["売価 master(税抜) 売価"]}</td>
                  <td>{item["売価 master(税抜) 下限"]}</td>
                  <td>{item["売価 master(税抜) 上限"]}</td>
                  <td>{item["売価 ズレ率（％）"]}</td>
                  <td>{item["ポイント 判定"]}</td>
                  <td>{item["ポイント DB ポイント"]}</td>
                  <td>{item["ポイント master ポイント"]}</td>
                  <td>{item["ポイント master 上限"]}</td>
                  <td>{item["ポイント master 下限"]}</td>
                  <td>{item["ポイント ズレ率（％）"]}</td>
                  <td>{item["定期おトク便 判定"]}</td>
                  <td>{item["定期おトク便 DB 有無"]}</td>
                  <td>{item["定期おトク便 master 有無"]}</td>
                  <td>{item["クーポン 文章"]}</td>
                  <td>{item["クーポン クーポン（％）"]}</td>
                  <td>{item["ユニプラ売価 組み合わせ"]}</td>
                  <td>{item["ユニプラ売価 ヘッダー無"]}</td>
                  <td>{item["合わせ買い 有無"]}</td>
                  <td>{item["マーキュリー 有無"]}</td>
                  <td>{item["カスタマーレビュー数 累計"]}</td>
                  <td>{item["カスタマーレビュー数 ★5"]}</td>
                  <td>{item["カスタマーレビュー数 ★4"]}</td>
                  <td>{item["カスタマーレビュー数 ★3"]}</td>
                  <td>{item["カスタマーレビュー数 ★2"]}</td>
                  <td>{item["カスタマーレビュー数 ★1"]}</td>
                  <td>{item["カスタマーレビュー評価"]}</td>
                  <td>{item["備考"]}</td>
                  <td>{item["要望"]}</td>
                </tr>
              );
            })
          }
        </tbody>
      </table>
    </div>
  );
}
