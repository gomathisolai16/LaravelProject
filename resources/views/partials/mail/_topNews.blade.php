<!-- TOP NEWS new row -->
<!-- MUST BE LOOPED TO GENERATE TOP NEWS USING BLADE -->
<!-- START -->
<?php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
?>
@foreach ($topNews as $news)
<tr style="width: inherit; height: inherit; border-bottom: 1px solid #F8F8F8;">
    <td style="width: inherit; height: inherit; padding: 10px 25px 10px 25px;" colspan="2">
        <!-- TOP NEWS title -->
        <!-- NOTE: Define environment HREF for proper redirection -->
        <a href="<?= $frontendAppURL ?>/top-news" target="_blank" style="text-decoration: none;">
            <div style="font-weight: bold; font-family: 'Arial'; font-size: 15px; color: #333333; padding-bottom: 10px;">
                {{$news->title}}
            </div>
        </a>
        <div style="display: table; width: 100%; height: inherit">
            <div style="display: table-row; width: inherit; height: inherit">
                <?php $img = null; ?>

                    <?php if(count($news->images) > 0) : ?>
                    <?php foreach ($news->images as $image) : ?>
                      <?php  $img = $image->size == 'small' ? $image : null; ?>
                   <?php  endforeach; ?>
                    <?php endif;?>
                    <?php $img = ($img == null && count($news->images) > 0) ? $news->images[0] : null; ?>
                <!-- TOP NEWS image -->
                <?php $image = $img == null ? null : $img->path ?>
                <!-- Change "src" attribute value and "visibility" CSS rule if new has image to display -->
                <div style="display: table-cell; width: 119px; height: 78px; padding-right: 10px; visibility: <?php echo $image !== null ? "visible" : "hidden" ?>">
                    <img src="<?php echo $image == null ? 'http://via.placeholder.com/119x78' : url('/').$image; ?>" style="width: 119px; height:78px;" />
                </div>
                <div style="display: table-cell; height: inherit; vertical-align: top;">
                    <!-- TOP NEWS description -->
                    <div style="font-family: 'Arial'; font-size: 13px; height: 58px; overflow: hidden;">
                        {!!  Str::limit($news->description, $limit = 200, $end = '...')  !!}
                    </div>
                    <div style="height: 20px;">
                        <!-- Ticker label -->
                        <div style="display: <?= count($news->tickers) == 0 ? 'none' : 'inline-block' ?>; font-weight: bold; font-family: 'Arial'; font-size: 12px; margin-right: 5px;  color: #687277;">
                            <?= count($news->tickers) == 0 ? "" : $news->tickers[0]->abbreviation ?>
                        </div>
                        <!-- Stock price label -->
                        <div style="display: <?= $news->percentage == 0 ? 'none' : 'inline-block'; ?>; font-weight: bold; font-family: 'Arial'; font-size: 12px; margin-right: 5px;">
                            <!-- Stock value -->
                            <div style="color: <?= $news->percentage >= 0 ? 'green' : 'red'; ?>;">
                                <img style="position: relative; top: 2px;" src="<?= $news->percentage >= 0 ? $upStockPublicPath : $downStockPublicPath ?>" width="12" height="12" /> {{$news->percentage}}%
                            </div>
                        </div>
                        <!-- Date label -->
                        <div style="display: inline-block; font-weight: bold; font-family: 'Arial'; font-size: 12px; margin-right: 5px; color: #BDCCD4;">
                            <?=Carbon::parse($news->release_date)->format('m/d/Y h:i:s A')." EST";?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
@endforeach
<!-- END -->