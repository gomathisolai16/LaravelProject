<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultImagesForImagePicker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $images = [];
        $date = \Carbon\Carbon::now()->toDateTimeString();
        $imageNamePaths = [];
        $imageNamePaths[] = [
            'title' => 'sandwich.jpg',
            'path' => '59fc8f8711015.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Air_France.jpg',
            'path' => '59fc8fbedd45a.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'medical.jpg',
            'path' => '59fc901b52996.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'jobsearch.jpg',
            'path' => '59fc91131615e.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Europe_stocks.jpg',
            'path' => '5a0032973285a.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'usa-flag-map.png',
            'path' => '5a003a74cf993.png'
        ];
        $imageNamePaths[] = [
            'title' => 'loan_generic_financial.jpg',
            'path' => '5a003fcde0c71.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'SoftBank (2).jpg',
            'path' => '5a0047dbf3671.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Michael_Kors_pic.jpg',
            'path' => '5a008ebaa585f.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Fever-Tree_pic.jpg',
            'path' => '5a017ec65f2b9.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'G4S_picture.jpg',
            'path' => '5a0190484e129.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'officehourscropped.jpg',
            'path' => '5a01b17587222.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'BA-BH301_NASDAQ_G_20150220192050.jpg',
            'path' => '5a01b1af8a161.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'broadcom1909a-e1509979551599.jpg',
            'path' => '5a01b585c6834.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'open_graph_logo.png',
            'path' => '5a01dce21ef12.png'
        ];
        $imageNamePaths[] = [
            'title' => 'photo.jpg',
            'path' => '5a01dce61a78b.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Red_Bay-1440.jpg',
            'path' => '5a01dd21bf643.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'volkswagen.png',
            'path' => '5a01dd26dda03.png'
        ];
        $imageNamePaths[] = [
            'title' => 'BMW-4-Series-Gran-Coupe-ModelCard.png',
            'path' => '5a01dd2e1e4e0.png'
        ];
        $imageNamePaths[] = [
            'title' => 'Digital-trade-across-borders.jpg',
            'path' => '5a01dd6fb268c.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'TRADE_MEDIUM.png',
            'path' => '5a01dd76e609c.png'
        ];
        $imageNamePaths[] = [
            'title' => '4fb932244b51fbd65f358de3246951f2.jpg',
            'path' => '5a01dd81bb68d.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'weibo.jpg',
            'path' => '5a01deb614412.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'crocs.jpg',
            'path' => '5a01e3ae55ac7.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'WallBroad.jpg',
            'path' => '5a01ec24602d3.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'iphone7shutter.jpg',
            'path' => '5a0208561e7d7.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'retailshutter.jpg',
            'path' => '5a02129c71818.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'headphonesshutter.jpg',
            'path' => '5a021ee011102.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => '127403501031282.jpg',
            'path' => '5a02c974b4bdb.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'London_aerial_view.jpg',
            'path' => '5a02d884932e9.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'energy_flame_generic.jpg',
            'path' => '5a02eba96d501.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'pub_generic_beer_tap_pic.jpg',
            'path' => '5a02f48a24cc1.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'snapchat (2).jpg',
            'path' => '5a030220297cb.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Regeneron_02.jpg',
            'path' => '5a031ec5263ff.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'european assets.jpg',
            'path' => '5a0326e9a06eb.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'NYSEflag.jp',
            'path' => '5a03313077203.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Wendys.jpg',
            'path' => '5a0332ac4aa7f.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'oil_pic_04.jpg',
            'path' => '5a03400c19c94.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'USeco1.jpg',
            'path' => '5a03419008d25.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'stockexchange2shutter.jpg',
            'path' => '5a0360457453b.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'carlicahn.jpeg',
            'path' => '5a0371d9b5c7f.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Burberry.jpg',
            'path' => '5a043551a546d.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'BN-VK115_38feR_OR_20171003103625.jpg',
            'path' => '5a045dc2dea42.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'BN-VK115_38feR_OR_20171003103625.jpg',
            'path' => '5a0473a92921f.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'apple.jpg',
            'path' => '5a047433b3829.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'AZN.jpg',
            'path' => '5a0483dda6bdf.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'generic_office (2).jpg',
            'path' => '5a048629f2e7f.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'kohls.jpg',
            'path' => '5a04ac5f16b0e.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'plumbing_generic (2).jpg',
            'path' => '5a058c1029e81.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'mining_aluminium.jpg',
            'path' => '5a0592a7e15ab.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'JC_Penney.jpg',
            'path' => '5a05d20006f7f.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'British_house.jpg',
            'path' => '5a05da0a49154.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'stockcity.jpg',
            'path' => '5a05e50023901.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'baba.jpg',
            'path' => '5a05eb7a76857.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'stockdown.jpg',
            'path' => '5a061e02aa14d.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'computer_server.jpg',
            'path' => '5a09843f8e996.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'GEbrick.jpg',
            'path' => '5a09fcc805a09.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'UKbutton.jpg',
            'path' => '5a09fd1c21a1b.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'QCOM.jpg',
            'path' => '5a09fd64a893a.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Germany_pic_01.jpg',
            'path' => '5a0ac03796673.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Germany_pic_02.jpg',
            'path' => '5a0ac05ec9401.jpeg'
        ];
        $imageNamePaths[] = [
        'title' => 'Germany_pic_03.jpg',
        'path' => '5a0ac07217ac0.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Germany_pic_04.jpg',
            'path' => '5a0ac07bc328d.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Germany_pic_05.jp',
            'path' => '5a0ac08556ede.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Germany_pic_06.jp',
            'path' => '5a0ac08e37b83.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Tesco.jpg',
            'path' => '5a0aca2dbe65c.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Vodafone (2).jpg',
            'path' => '5a0ad3ace898d.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Walkie_Talkie_image.jpg',
            'path' => '5a0b1cf97c294.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Homedepot.jpg',
            'path' => '5a0b20ee77213.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'yuan.jpg',
            'path' => '5a0b4e1ceeec5.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'atlantafedbostic.jpg',
            'path' => '5a0b514b199b7.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'stockblue.jpg',
            'path' => '5a0b6745daa6a.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'TalkTalk.jpg',
            'path' => '5a0c208e43fd2.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Experian.jpg',
            'path' => '5a0c2d660fc68.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'tencent.jpg',
            'path' => '5a0c3d4936748.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'retailshutter.jpg',
            'path' => '5a0c5c75eb833.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'cisco.jpg',
            'path' => '5a0c798f0e389.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'groceryshutter.jpg',
            'path' => '5a0c9d7d61112.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'cordray.jpg',
            'path' => '5a0ca2b952083.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'JustEat.jpg',
            'path' => '5a0d7a5e5fb61.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'wmtonline.jpg',
            'path' => '5a0d96421f6ef.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'royalmail.jpg',
            'path' => '5a0da05034543.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'workers.jpg',
            'path' => '5a0da451836be.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'netapp.jpeg',
            'path' => '5a0da9530dbb8.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'dollar_bills.jpg',
            'path' => '5a0dbc237477d.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'money.jpg',
            'path' => '5a0dbd9f03632.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'GBP.jpg',
            'path' => '5a0dbeb8a2ebf.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'ROK.jpeg',
            'path' => '5a0dc9d193aa6.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'ROK1.jpeg',
            'path' => '5a0dc9f791490.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Newhome.jpg',
            'path' => '5a0dd346e9615.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'railroadtracks.jpg',
            'path' => '5a0df869283d0.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'stockbrd.jpg',
            'path' => '5a0e08cf8d1f4.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'computer_server.jpg',
            'path' => '5a0ec3405ac42.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'teslasemi.jpeg',
            'path' => '5a0ee86c105b1.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'ross.jpg',
            'path' => '5a0ef03a5cbfc.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'EA.jpg',
            'path' => '5a0efbcdd4969.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'Broadcom.jpg',
            'path' => '5a0f14093e3a2.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'oilrigs.jpg',
            'path' => '5a0f32acc8bfe.jpeg'
        ];
        $imageNamePaths[] = [
            'title' => 'pipeline.jpg',
            'path' => '5a0f49772da50.jpeg'
        ];


        foreach ($imageNamePaths as $img) {
            $images[] = [
                'size' =>'original',
                'title' => $img['title'],
                'path' => '/img/news/'.$img['path'],
                'created_at' => $date,
                'updated_at'=> $date,
            ];
            $images[] = [
                'size' =>'small',
                'title' => $img['title'],
                'path' => '/img/news/small/'.$img['path'],
                'created_at' => $date,
                'updated_at'=> $date,
            ];
            $images[] = [
                'size' =>'medium',
                'title' => $img['title'],
                'path' => '/img/news/medium/'.$img['path'],
                'created_at' => $date,
                'updated_at'=> $date,
            ];
        }

        \App\Models\Image::insert($images);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
