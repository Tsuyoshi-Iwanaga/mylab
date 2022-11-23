import operator

routes = {
  1: {2: 5, 3: 4, 4: 1},
  2: {1: 5, 5: 2},
  3: {1: 4, 4: 2, 5: 5, 8: 6},
  4: {1: 1, 3: 2},
  5: {2: 2, 6: 1, 3: 5, 7: 3},
  6: {5: 1, 7: 4},
  7: {6: 4, 5: 3, 8: 2},
  8: {3: 6, 7: 2},
}

def _dijkstra(fr: int, to: int, weights: dict) -> tuple[float, list[int]]:
    """出発地から目的地までの最適ルートを探索する。
    Args:
      fr (int): 出発地の地点ID
      to (int): 目的地の地点ID
      weights (dict): 各地点間のCO2排出量を表すリスト
    Returns:
      tuple[float, list[int]]: 選択した経路を通過した場合のCO2排出量 と 出発地から目的地まで経由する地点IDのリスト
    """
    # 確定済み地点のリスト
    fixed_points = []
    now_point = fr

    # 全ての地点の初期化
    tree = {}
    for node in weights.keys():
      tree[node] = { 'co2': float('inf'), 'before_point': None }

    # スタート地点を初期化
    tree[fr] = {'co2': 0, 'before_point': None}

    while True:
      # 全体の地点の中で一番CO2排出量が少ないかつ確定していない地点を調べる
      tmp = float('inf')
      index = None
      for node in tree.keys():
        if (tmp > tree[node]['co2']) and (not node in fixed_points):
          tmp = tree[node]['co2']
          index = node

      # 上記の地点を確定済みリストに追加
      fixed_points.append(index)

      # 確定した地点から行くことができ、かつ未確定な地点に対してCO2排出量を計算
      # 計算した値が元々入っているCO2排出量よりも少ない場合は排出量とそれに至る経路を更新する
      for may_next_point in weights[index].keys():
        calcCo2 = tree[index]['co2'] + weights[index][may_next_point]
        if calcCo2 < tree[may_next_point]['co2']:
          tree[may_next_point]['co2'] = calcCo2
          tree[may_next_point]['before_point'] = index

      # 現在の地点を更新
      now_point = index
      
      # 全ての地点が確定済みになったら終了
      if len(fixed_points) == len(tree.keys()):
        break

    # 到着地から出発地に遡って最短ルートのリストを作成する
    routes = [to]
    counter = to
    while True:
      if tree[counter]['before_point'] == None: break #出発と到着が同じ地点の場合
      routes.insert(0, tree[counter]['before_point'])
      counter = tree[counter]['before_point']
      if counter == fr:
        break

    print(tree[to]['co2'])
    print(routes)
    return (tree[to]['co2'], routes)

_dijkstra(1, 7, routes) #10 [1, 2, 5, 7]
_dijkstra(7, 1, routes) #10 [7, 5, 2, 1]
_dijkstra(1, 1, routes) #0 [1] スタートとゴールが同じ場合