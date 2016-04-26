<?php
      if(sizeof($carrousselImages) > 0){
          
        echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">';
        echo '<div class="carousel-inner" role="listbox">';
      
    
          foreach($carrousselImages as $key => $image){
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
        echo '<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>';
          
      }
?>