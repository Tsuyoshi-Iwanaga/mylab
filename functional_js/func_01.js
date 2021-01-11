//JavaScript関数型の導入

//【修正前】副作用をもつ例
;(function(){

  function showStudent(ssn) {
    //dbは引数で宣言されていない、つまり外部の変数であり、nullになっていることもある
    //つまり呼び出しごとに結果が異なる可能性がある
    let student = db.find(ssn)
    
    if(student !== null) {
      //HTMLに直接変更を加えている。
      //HTML自体が可変かつ共有されたグローバルなリソースである
      document.querySelector(`${student.ssn}/${student.firstname}/${student.lastname}`)
    } else {
      //例外を投げる場合がある
      throw new Error('Student not found!')
    }
  }
  showStudent('444-44-4444')
})();


//【修正版】大きな関数を小さな関数に分割、副作用を持つ関数とそうでない関数を分ける
//また、外部の変数を受け取っている箇所は引数のパラメータを明示的に定義する
//カリー化: 関数の引数のいくつかを部分的に設定し、パラメータを1つまで減らすことができる
;(function(){

  //レコードを取得する処理(dbオブジェクトへの参照と、検索のためのIDが必要)
  const find = curry((db, id)  => {
    let obj = db.find(id)
    if(obj === null) {
      throw new Error('Object not found')
    }
    return obj
  })
  
  //学生オブジェクトをCSV文字列に変換する関数
  const csv = student => `${student.ssn}/${student.firstname}/${student.lastname}`
  
  //文字列をDOMの特定箇所へ反映する関数
  const append = curry((selector, info) => {
    document.querySelector(selector).innerHTML = info
  })
  
  //関数を合成
  const showStudent = run(append('#student-info'), csv, find(db))
  showStudent('444-44-4444')
})();

//参照透過性: 関数が純粋であることを特徴づける性質。引数と返り値に明確な関連性があり、常に同じ値を返す
;(function(){
  var input = [80, 90, 100]

  //等式推論が成り立つ(つまり参照透過)関数群
  const sum = arr => arr.reduce((total, current) => total + current)
  const size = arr => arr.length
  const devide = (a, b) => a / b
  const average = arr => devide(sum(arr), size(arr))

  average(input)
})()

//不変性: 配列やオブジェクトは不変ではない
;(function() {
  const sortDesc = arr => arr.sort((a, b) => b - a)
  var arr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
  sortDesc(arr)
  console.log(arr)
})()

//関数チェーン
;(function() {
  let enrollment = [
    {enrolled: 2, grade: 100},
    {enrolled: 2, grade: 80},
    {enrolled: 1, grade: 89},
  ]

  //命令型の場合
  // var totalGrades = 0;
  // var totalStudentFound = 0;
  // for(let i = 0; i < enrollment.length; i++) {
  //   let student = enrollment[i]
  //   if(student !== null && student.enrolled > 1) {
  //     totalGrades += student.grade;
  //     totalStudentFound++
  //   }
  // }
  // var average = totalGrades / totalStudentFound
  // console.log(average)

  //関数型(Lodash)
  //変数の宣言,変数への再代入,ループ,if-elseを排除できている
  _.chain(enrollment)
    .filter(student => student.enrolled > 1)
    .plunk('grade')
    .average()
    .value()
})()

//非同期処理
;(function(){
  //命令型
  // var valid = false
  // var elem = document.queryselector('#student-ssn')
  // elem.onkeyup = function(event) {
  //   var val = elem.value
  //   if(val !== null && val.length !== 0) {
  //     val = val.replace(/^\s*|\s*$|\s/g, '')
  //     if(val.length === 9) {
  //       console.log(`valid ssn: ${val}`)
  //       valid = true
  //     }
  //   } else {
  //     console.log(`invalid ssn: ${val}!`)
  //   }
  // }

  //関数型(Rxjs)
  Rx.Observable.fromEvent(document.querySelector('#student-ssn'), 'keyup')
    .plunk('srcElement', 'value')
    .map(ssn => ssn.replace(/^\s*|\s*$|\s/g, ''))
    .filter(ssn => ssn !== null && ssn.length === 9)
})()