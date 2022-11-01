<?php
$hours = [];
for($i = 10; $i < 24; $i++){
    array_push($hours, ($i . ':00'));
}

$seats = [];
for($i = 1; $i < 256; $i++){
    array_push($seats, ($i));
}

return [
    'AREAS' => ['東京都', '大阪府', '福岡県'],
    'GENRES' => [
        '寿司', '焼肉', '居酒屋', 'イタリアン', 'ラーメン'
    ],
    'DUMMY_IMAGES_PATH' => 'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/',
    'GENRE_IMAGE_NAMES' => [
        'sushi', 'yakiniku', 'izakaya', 'italian', 'ramen'
    ],

    'AVAILABLE_HOURS' => $hours,
    'AVAILABLE_SEATS' => $seats,

    'REQUIRED' => '入力必須項目です',
    'OVER_MAX' => '191文字以下で入力してください',
    'OVER_MAX_NUM' => '255人以下で予約してください',
    'NOT_STRING' => '文字列で入力してください',
    'NOT_INT' => '整数で入力してください',
    'NOT_EMAIL' => 'メールアドレス形式で入力してください',
    'NOT_DATETIME' => '日付形式で入力してください',
    'NOT_UNIQUE' => '登録済みのメールアドレスです',
    'UNDER_MIN' => '8文字以上入力してください',
    'NOT_IDENTIFIED' => 'メールかパスワードが一致しません',
    'NOT_EXISTS' => '未登録のメールアドレスです',
    'PAST_DAY' => '過去の日付です',
];