<?php

use Illuminate\Database\Seeder;

class TickerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        factory(\App\Models\Ticker::class, 50)->create();

        $relationArray = [];

        for ($i = 0; $i < 50; $i++) {
            $relationArray[] = [
                'new_id' => rand(1, 50),
                'ticker_id' => rand(1, 50),
            ];
        }


        \DB::table('new_ticker')->insert($relationArray);
        */
        \App\Models\Ticker::insert([
            [
                'abbreviation' => "APPL",
            ],
            [
                'abbreviation' => "SNGS",
            ],
            [
                'abbreviation' => "GOOG",
            ],
            [
                'abbreviation' => "MSFT",
            ],
            [
                'abbreviation' => "SSNLF",
            ],
            [
                'abbreviation' => "WTI",
            ],
            [
                'abbreviation' => "LCOc1",
            ],
            [
                'abbreviation' => "LNG.A",
            ],
            [
                'abbreviation' => "TELL.O",
            ],
            [
                'abbreviation' => "AMZN",
            ],
            [
                'abbreviation' => "EBAY",
            ],
            [
                'abbreviation' => "CLN.S",
            ],
            [
                'abbreviation' => "HUN.N",
            ],
            [
                'abbreviation' => "TSLA",
            ],
            [
                'abbreviation' => "VOWG",
            ],
            [
                'abbreviation' => "ROBEX",
            ],
            [
                'abbreviation' => "Antam",
            ],
            [
                'abbreviation' => "Ghana",
            ],
            [
                'abbreviation' => "UNC.AS",
            ],
            [
                'abbreviation' => "AKZO.AS",
            ],
            [
                'abbreviation' => "FT",
            ],
            [
                'abbreviation' => "SAZ",
            ],
            [
                'abbreviation' => "GLEN",
            ],
            [
                'abbreviation' => "ANZ",
            ],
            [
                'abbreviation' => "ICBM",
            ],
            [
                'abbreviation' => "Saudia",
            ],
            [
                'abbreviation' => "FBI",
            ],
            [
                'abbreviation' => "Kaspersky",
            ],
            [
                'abbreviation' => "NEST",
            ],
            [
                'abbreviation' => "UBS",
            ],
            [
                'abbreviation' => "EMEA",
            ],
            [
                'abbreviation' => "HPQ.N",
            ],
            [
                'abbreviation' => "BLK",
            ],
            [
                'abbreviation' => "TOTF.PA",
            ],
            [
                'abbreviation' => " QATPE.UL",
            ],
            [
                'abbreviation' => "EMSTEL.SIEA",
            ],
            [
                'abbreviation' => "CMTL.OQ",
            ],
            [
                'abbreviation' => "CPSS",
            ],
            [
                'abbreviation' => "T",
            ],
            [
                'abbreviation' => "CHTR",
            ],
            [
                'abbreviation' => "SPI",
            ],
            [
                'abbreviation' => "RB.L",
            ],
            [
                'abbreviation' => "ESSR.L",
            ],
            [
                'abbreviation' => "FLS",
            ],
            [
                'abbreviation' => "NAFTA",
            ],
            [
                'abbreviation' => "NESN",
            ],
            [
                'abbreviation' => "SBRY",
            ],
            [
                'abbreviation' => "FTSE",
            ]
        ]);
/*        $insertNewTicker[] = [
            'new_id' => 1,
            'ticker_id' => 1
        ];
        $insertNewTicker[] = [
            'new_id' => 2,
            'ticker_id' => 2
        ];
        $insertNewTicker[] = [
            'new_id' => 4,
            'ticker_id' => 3 //GOOG
        ];
        $insertNewTicker[] = [
            'new_id' => 4,
            'ticker_id' => 1 //APPL
        ];
        $insertNewTicker[] = [
            'new_id' => 4,
            'ticker_id' => 4 //MSFT
        ];
        //5
        $insertNewTicker[] = [
            'new_id' => 5,
            'ticker_id' => 5 //SSNLF
        ];
        $insertNewTicker[] = [
            'new_id' => 6,
            'ticker_id' => 6 //WTI
        ];
        $insertNewTicker[] = [
            'new_id' => 6,
            'ticker_id' => 7 //LCOc1
        ];
        //7
        $insertNewTicker[] = [
            'new_id' => 7,
            'ticker_id' => 8
        ];
        $insertNewTicker[] = [
            'new_id' => 7,
            'ticker_id' => 9
        ];
        $insertNewTicker[] = [
            'new_id' => 8,
            'ticker_id' => 5
        ];
        $insertNewTicker[] = [
            'new_id' => 9,
            'ticker_id' => 1
        ];
        $insertNewTicker[] = [
            'new_id' => 9,
            'ticker_id' => 3
        ];
        $insertNewTicker[] = [
            'new_id' => 9,
            'ticker_id' => 10
        ];
        $insertNewTicker[] = [
            'new_id' => 9,
            'ticker_id' => 4
        ];
        $insertNewTicker[] = [
            'new_id' => 9,
            'ticker_id' => 11
        ];
        $insertNewTicker[] = [
            'new_id' => 10,
            'ticker_id' => 12
        ];
        $insertNewTicker[] = [
            'new_id' => 10,
            'ticker_id' => 13
        ];
        $insertNewTicker[] = [
            'new_id' => 11,
            'ticker_id' => 14
        ];
        $insertNewTicker[] = [
            'new_id' => 12,
            'ticker_id' => 15
        ];
        $insertNewTicker[] = [
            'new_id' => 13,
            'ticker_id' => 16
        ];
        $insertNewTicker[] = [
            'new_id' => 14,
            'ticker_id' => 26
        ];
        $insertNewTicker[] = [
            'new_id' => 15,
            'ticker_id' => 25
        ];
        \DB::table('new_ticker')->insert($insertNewTicker);*/
    }
}
