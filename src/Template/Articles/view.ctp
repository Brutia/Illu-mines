<!-- File: src/Template/Articles/view.ctp -->
<div class="container content">
    <div class="row">
        <div class="col-lg-12 page-title">
            <?= h($article->title) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 date">
            <?= $article->created->format('F jS, Y') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1 article">
            <?php echo $this->BBCode->render($article->body); ?>

            <?php
                  if(sizeof($articleImages) > 0){

                    echo '<div id="articleCarousel" class="carousel slide" data-ride="carousel">';

                    echo '<ol class="carousel-indicators">';
                        for($i = 0; $i < sizeof($articleImages); $i++){
                            if($i == 0)
                                echo '<li data-target="#articleCarousel" data-slide-to="'. $i .'" class="active"></li>';
                            else {
                                echo '<li data-target="#articleCarousel" data-slide-to="'. $i .'"></li>';
                            }
                        }
                    echo '</ol>';

                    echo '<div class="carousel-inner" role="listbox">';

                      foreach($articleImages as $key => $image){
                          if($key == 0){
                              echo '<div class="item active">';
                              echo $this->Html->image($image['name'], ['style' => 'width: 100%']);
                              echo '</div>';
                          }
                          else{
                              echo '<div class="item">';
                              echo $this->Html->image($image['name'], ['style' => 'width: 100%']);
                              echo '</div>';
                          }
                      }


                    echo '</div>';
                    echo '<a class="left carousel-control" href="#articleCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="right carousel-control" href="#articleCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                    </div>';

                  }
            ?>
        </div>
    </div>
</div>
