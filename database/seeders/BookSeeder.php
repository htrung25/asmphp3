<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'Laravel từ Zero đến Hero',
                'Học Laravel từ cơ bản đến nâng cao với dự án thực tế',
                'Matt Stauffer',
                'NXB Thanh Niên',
                '2023-01-01',   // ← sửa thành dạng ngày
                299000,
                50,
                1
            ],
            [
                'PHP & MySQL Web Development',
                'Sách kinh điển dành cho lập trình viên PHP',
                'Luke Welling',
                'Addison-Wesley',
                '2017-05-15',
                450000,
                30,
                1
            ],
            [
                'Clean Code tiếng Việt',
                'Bí kíp viết code sạch như cao thủ',
                'Robert C. Martin',
                'NXB Trẻ',
                '2020-10-20',
                199000,
                80,
                2
            ],
            [
                'JavaScript Nâng Cao',
                'ES6+ và các pattern hiện đại',
                'Kyle Simpson',
                'O’Reilly',
                '2024-03-10',
                320000,
                45,
                1
            ],
            [
                'Thiết kế UX/UI thực chiến',
                'Từ Figma đến sản phẩm thật',
                'Steve Krug',
                'NXB Kim Đồng',
                '2022-08-05',
                280000,
                60,
                2
            ],
            [
                'Lập trình viên thực chiến',
                'Kỹ năng mềm và phỏng vấn IT',
                'John Sonmez',
                'Pragmatic Bookshelf',
                '2021-12-01',
                179000,
                100,
                3
            ],
        ];

        foreach ($books as $i => $b) {
            Book::create([
                'title'       => $b[0],
                'description' => $b[1],
                'author'      => $b[2],
                'publisher'   => $b[3],
                'publication' => $b[4],
                'price'       => $b[5],
                'quantity'    => $b[6],
                'category_id' => $b[7],
                'image'       => 'book-' . ($i + 1) . '.jpg',
                'thumbnail'   => 'book-' . ($i + 1) . '.jpg',
                'view_count'  => rand(500, 3500),
            ]);
        }
    }
}
