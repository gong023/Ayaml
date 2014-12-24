

```yaml
# hoge.yaml
valid_user:
  id: 1
  name: Taro
  created: 2014-01
```

```php
// 一番平易なパターン
Ayaml::file('hoge.yaml')->schema('valid_user')->dump();
=> ['id' => 1, 'name' => 'Taro', 'created' => '2014-01'];

// 上書きするパターン
Ayaml::file('hoge.yaml')->schema('valid_user')->with(['name' => 'John'])->dump();
=> ['id' => 1, 'name' => 'John', 'created' => '2014-01'];

// シーケンシャルに作る
// ここから下は作るの大変だし必要かも怪しいので余裕があったら作る
$validUser = Ayaml::file('hoge.yaml')->schema('valid_user');
Ayaml::seq($validUser)->range('id', 10, 12)->byOne()->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 11, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 12, 'name' => 'Taro', 'created' => '2014-01'],
];

Ayaml::seq($validUser)->range('id', 10, 8)->byOne()->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 9,  'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 8,  'name' => 'Taro', 'created' => '2014-01'],
]

Ayaml::seq($validUser)->range('id', 10, 12)->by(function($id) { return $id + 2; })->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 12, 'name' => 'Taro', 'created' => '2014-01'],
];

Ayaml::seq($validUser)->between('created', '2014-01', '2014-03')->byMonth()->dump();
=>
[
  ['id' => 1, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 1, 'name' => 'Taro', 'created' => '2014-02'],
  ['id' => 1, 'name' => 'Taro', 'created' => '2014-03'],
];

Ayaml::seq($validUser)
  ->range('id', 10, 13)->byOne()
  ->between('created', '2014-01', '2014-03')->byMonth()
  ->dump();
=>
[
  ['id' => 10, 'name' => 'Taro', 'created' => '2014-01'],
  ['id' => 11, 'name' => 'Taro', 'created' => '2014-02'],
  ['id' => 12, 'name' => 'Taro', 'created' => '2014-03'],
];
```