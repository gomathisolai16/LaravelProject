<!-- WATCHLIST new row -->
<!-- MUST BE LOOPED TO GENERATE WATCHLIST NEWS USING BLADE -->
<!-- START -->
<?php use Carbon\Carbon; ?>
@foreach ($watchListNews as $news)
<tr style="width: inherit; height: inherit; border-bottom: 1px solid #F8F8F8;">
    <td style="width: 30%; height: inherit; padding: 10px 0px 10px 25px;">
        <!-- Ticker label -->
        <table style="width: 217px;">
            <tr style="width: inherit; height: inherit;">
                <!-- News ticker -->
                <?php if(count($news->tickers) != 0): ?>
                    <td style="font-weight: bold; font-family: 'Arial'; font-size: 12px; margin-right: 5px;  color: #687277; text-align: left; width: 40px;">
                        <?= count($news->tickers) == 0 ? "" : $news->tickers[0]->abbreviation ?>
                    </td>
                <?php endif; ?>
                <!-- Stock value -->
                <?php if($news->percentage != 0): ?>
                    <td style="font-weight: bold; font-family: 'Arial'; font-size: 12px; margin-right: 5px; text-align: left;">
                        <div style="color: <?= $news->percentage >= 0 ? 'green' : 'red'; ?>;">
                            <img style="position: relative; top: 2px;" src="<?= $news->percentage >= 0 ? $upStockPublicPath : $downStockPublicPath ?>" width="12" height="12" /> {{$news->percentage}}%
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
            <tr style="width: inherit; height: inherit;">
                <!-- Date label -->
                <td colspan="<?= count($news->tickers) == 0 ? '1' : '2' ?>" style="font-weight: bold; font-family: 'Arial'; font-size: 12px; margin-right: 5px; color: #BDCCD4;">
                    <?=Carbon::parse($news->release_date)->format('m/d/Y h:i:s A')." EST";?>
                </td>
            </tr>
        </table>
    </td>
    <!-- WATCHLIST news title -->
    <td style="width: 70%; height: inherit;  padding: 10px 25px 10px 0px;">
        <!-- NOTE: Define environment HREF for proper redirection -->
        <a href="<?= $frontendAppURL ?>/dashboard" target="_blank" style="text-decoration: none;">
            <div style="font-weight: bold; font-family: 'Arial'; font-size: 15px; color: #333333;">
                {{$news->title}}
            </div>
        </a>
    </td>
</tr>
@endforeach
<!-- END -->