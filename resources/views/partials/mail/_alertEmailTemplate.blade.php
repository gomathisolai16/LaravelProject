<?php
    $frontendAppURL = config('app.frontend_url');
    $logoPublicPath = url('img/mail-assets/nc-logo@2x.png');
    $poweredByPublicPath = url('img/mail-assets/powered-by@2x.png');
    $upStockPublicPath = url('img/mail-assets/arrow_up_stock_price_change.png');
    $downStockPublicPath = url('img/mail-assets/arrow_down_stock_price_change.png');
    $facebookPublicPath = url('img/mail-assets/icn-fb@2x.png');
    $twitterPublicPath = url('img/mail-assets/icn-tw@2x.png');
    $year = date('Y');

    /* Remove comments for quick test of email template */

    // $user = new stdClass();
    // $user->first_name = "Lorem";
    // $user->last_name = "Ipsum";
    // $user->username = "lorem_ipsum";

    // $ticker = new stdClass();
    // $ticker->abbreviation = "APPL";

    // $image = new stdClass();
    // $image->path = 'http://via.placeholder.com/119x78';

    // $newRecord = new stdClass();
    // $newRecord->title = "Some top new title";
    // $newRecord->description = "Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem";
    // $newRecord->tickers = [
    //      $ticker,
    //      $ticker
    // ];
    // $newRecord->percentage = 30;
    // $newRecord->release_date = "2017-11-22 11:25 AM EST";
    // $newRecord->images = [
    //     $image,
    // ];

    // $topNews = [
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    // ];

    // $watchListNews = [
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    //     $newRecord,
    // ];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta content="text/html" http-equiv="Content-Type">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>NewsConnect Informer</title>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <table style="width: 100%; height: 100%; background-color: #F2F2F2;">
            <tr style="width: inherit; height: inherit;">
                <td style="vertical-align: middle; width: inherit; height: inherit;">
                    <div style="padding: 10px 40px;">
                        <!-- Email header -->
                        <table style="height: 60px; width: 100%;">
                            <tr style="width: inherit; height: inherit;">
                                <!-- Email logo container -->
                                <td style="width: 33.333333%; vertical-align: middle; padding-left: 10px;">
                                    <img src="<?= $logoPublicPath ?>" width="94" height="37" />
                                </td>
                                <!-- Email 'ALERT' text container -->
                                <td style="width: 33.333333%; vertical-align: middle; text-align: center; font-weight: bold; font-size: 24px; color: #C22839; font-family: 'Arial';">
                                    ALERT
                                </td>
                                <!-- Email power by logo container -->
                                <td style="width: 33.333333%; vertical-align: middle; text-align: right; padding-right: 10px;">
                                    <img src="<?= $poweredByPublicPath ?>" width="76" height="23" />
                                </td>
                            </tr>
                        </table>
                        <!-- Email body -->
                        <div style="border-radius: 3px; background-color: #FFFFFF;">
                            <!-- Presentation section -->
                            <table style="width: 100%; border-collapse: collapse; background-color: #FFFFFF;">
                                <!-- WATCHLIST section header -->
                                <tr style="width: inherit; height: inherit;">
                                    <td style="height: inherit; padding: 25px 25px 25px 25px;">
                                        <h4 style="margin: 0px; font-family: 'Arial'; font-size: 18px;">
                                            Dear {{$user->first_name}},
                                       </h4>
                                    </td>
                                </tr>
                                <tr style="width: inherit; height: inherit;">
                                    <td style="height: inherit; font-family: 'Arial'; font-size: 14px; text-align: left; padding: 0px 25px 25px 25px;">
                                       Here is your News Connect daily summary:
                                    </td>
                                </tr>
                            </table>
                            <!-- </div> -->
                            <!-- WATCHLIST Section -->
                            <table style="width: 100%; border-collapse: collapse; background-color: #FFFFFF;">
                                <!-- WATCHLIST section header -->
                                <tr style="width: inherit; height: inherit;">
                                    <td style="height: inherit; font-family: 'Arial'; font-size: 14px; font-weight: bold; text-align: left; padding-left: 25px; padding-bottom: 8px; border-bottom: 1px solid #F8F8F8;">
                                        NEWS ALERTS
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%; border-collapse: collapse; background-color: #FFFFFF;">
                                <!-- List here WATCHLIST news -->
                                @include('partials/mail/_watchlistNews')
                                <!-- Render in case when empty news list is present -->
                                {{-- @include('partials/mail/_emptyNewsList') --}}
                            </table>
                            <!-- TOP NEWS section -->
                            <table style="width: 100%; border-collapse: collapse; margin-top: 16px; background-color: #FFFFFF;">
                                <!-- WATCHLIST section header -->
                                <tr style="width: inherit; height: inherit;">
                                    <td style="height: inherit; font-family: 'Arial'; font-size: 14px; font-weight: bold; text-align: left; padding-left: 25px; padding-bottom: 8px; border-bottom: 1px solid #F8F8F8;">
                                        TOP NEWS
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%; border-collapse: collapse; background-color: #FFFFFF;">
                                <!-- List here TOP NEWS news -->
                                @include('partials/mail/_topNews')
                                <!-- Render in case when empty news list is present -->
                                {{-- @include('partials/mail/_emptyNewsList') --}}
                            </table>
                            <!-- Regards section -->
                            <table style="width: 100%; border-collapse: collapse; background-color: #FFFFFF;">
                                <tr style="width: inherit; height: inherit">
                                    <td style="height: inherit; padding: 20px 21px;">
                                        <span style="font-family: 'Arial'; font-size: 14px; color: #333333;">
                                            Sincerely,
                                        </span>
                                        <br />
                                        <span style="font-weight: bold; font-family: 'Arial'; font-size: 14px; color: #333333;">
                                            MT Newswires team
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <table style="width: 100%; font-family: 'Arial'; font-size: 14px; padding: 10px 50px 2px 50px;background-color: #F2F2F2;">
            <tr style="width: inherit; height: inherit;">
                <td style="padding-bottom: 10px; border-bottom: 1px solid #D2D2D2;">
                    In case you wish to unsubscribe from your <strong style="color: #C22839;">News</strong> <strong>Connect</strong> daily summary, change your <strong><a href="<?= $frontendAppURL ?>/dashboard?accountSettings=1" target="_blank" style="text-decoration: none; color: #3FA9F5;">Account Settings</a></strong>
                </td>
            </tr>
        </table>
        <div style="font-family: 'Arial'; padding: 10px 50px; background-color: #F2F2F2;">
            <table style="width: 100%; height: inherit;">
                <tr style="width: inherit; height: inherit;">
                    <td style="vertical-align: middle; font-size: 11px; color: #999999;">
                        Copyright © {{ $year }} MT Newswires, a Division of MidnightTrader, Inc. All rights reserved.
                    </td>
                    <td style="vertical-align: middle; font-size: 10px; color: #999999; text-align: right; width: 73px;">
                        <a href="http://www.demonce.com/contact-us" style="text-decoration: none; color: #999999 !important;" target="_blank">CONTACT US</a>
                    </td>
                    <td style="vertical-align: middle; text-align: right; width: 54px;">
                        <a href="https://twitter.com/midnighttrader" target="_blank"><img src="<?= $twitterPublicPath ?>" width="21" height="21" /></a> <a href="https://www.facebook.com/MidnightTrader" target="_blank"><img src="<?= $facebookPublicPath ?>" width="21" height="21" /></a>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>