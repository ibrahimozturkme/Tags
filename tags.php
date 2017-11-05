<?php

     /*
     *    Class Tags
     *
     *    @author İbrahim ÖZTÜRK <work@ibrahimozturk.me>
     *    @web http://ibrahimozturk.me
     *
     *    @author Sezai Özarslan <sezai.ozarslan@webtures.com>
     *
     *    @link https://ibrahimozturk.me/yazi/11-tags-kutuphanesi
     *    @version 1.0.0
     *
     */

     Class Tags{

          /*
          * Tags
          *
          * @var array
          */
          public $tags   = [];

          /*
          * Head
          *
          * @var array
          */
          public $head   = [];

          /*
          * Files
          *
          * @var array
          */
          public $files  = [];

          /*
          *    Constructor
          */
          public function __construct(){}

          /*
          * Set
          *
          * @param string          $type
          * @param string|array    $args
          *
          * @return $this
          */
          public function set($type, $args){
               $append   = [];
               if(is_array($args)){
                    foreach($args as $key => $value){
                         if(is_numeric($key)){
                              $this->compile($type, $value);
                         }else{
                              $append[$key] = $value;
                         }
                    }
               }else{
                    $this->compile($type, [$args]);
               }

               if($append){
                    $this->compile($type, $append);
               }

               return $this;
          }

          /*
          * Compile
          *
          * @param string     $tag
          * @param array      $args
          *
          */
          private function compile($tag, $args){
               if($tag == 'title'){
                    $this->tags[$tag]   = $args[0];
               }else{
                    $this->tags[$tag][] = $args;
               }
          }

          /*
          * Create Tags
          */
          private function create_tags(){

               $this->files   = [];
               $this->head    = [];

               foreach($this->tags as $tag => $data){
                    if($tag == 'title'){

                         $this->head[$tag]   = '<title>'.$data.'</title>';

                    }else if($tag == 'style'){

                         $new_data = array_map(function($item){
                              $output   = '';
                              $content  = $item['<>'];
                              unset($item['<>']);
                              foreach($item as $k => $v){
                                   $output   .= ' '.$k.'="'.$v.'"';
                              }
                              $this->head['style'][]             = '<style'.$output.'>'.$content.'</style>';
                              $this->files['href']['code'][]     = $content;
                         }, $data);

                    }else if($tag == 'script'){

                         $new_data = array_map(function($item){
                              $output   = '';
                              $content  = '';
                              foreach($item as $k => $v){
                                   if($k == '{}'){
                                        $content  .= $v;
                                        $this->files['src']['code'][] = $content;
                                   }else{
                                        if($k == 'src'){
                                             $this->files['src']['url'][]  = $v;
                                        }
                                        $output   .= ' '.$k.'="'.$v.'"';
                                   }
                              }
                              $this->head['script'][]  = '<script'.$output.'>'.$content.'</script>';
                         }, $data);

                    }else{
                         $new_data = array_map(function($item){
                              $output   = '';
                              foreach($item as $k => $v){
                                   if($k == 'href'){
                                        $this->files['href']['url'][] = $v;
                                   }
                                   $output   .= ' '.$k.'="'.$v.'"';
                              }
                              return $output;
                         }, $data);

                         for($i = 0; $i < count($new_data); $i++){
                              $this->head[$tag][]   = '<'.$tag.$new_data[$i].'/>';
                         }
                    }
               }
          }

          /*
          * Export
          *
          * @param array|string    $order
          * @param bool            $array
          * @param bool            $append_code
          *
          * @return string         $output
          */
          public function export($order = null, $array = false, $append_code = false){
               $this->create_tags();

               $order    = (!isset($order))                      ? array()           : $order;
               $order    = (isset($order) && !is_array($order))  ? array($order)     : $order;

               if($array){
                    $output   = [];
                    foreach($order as $k => $group){

                         $group    = ($group == 'script')   ? 'src'   : $group;
                         $group    = ($group == 'link')     ? 'href'  : $group;

                         if(isset($this->files[$group]['url'])){
                              if(is_array($this->files[$group]['url'])){
                                   foreach($this->files[$group]['url'] as $tag){
                                        $output[] = $tag;
                                   }
                              }else{
                                   $output[] = $this->head[$group];
                              }
                         }
                         if($append_code){
                              if(isset($this->files[$group]['code'])){
                                   if(is_array($this->files[$group]['code'])){
                                        foreach($this->files[$group]['code'] as $tag){
                                             $output[] = $tag;
                                        }
                                   }else{
                                        $output[] = $this->head[$group];
                                   }
                              }
                         }else{
                         }
                    }
               }else{
                    $output   = '';
                    foreach($order as $group){

                         if(isset($this->head[$group])){
                              if(is_array($this->head[$group])){
                                   foreach($this->head[$group] as $tag){
                                        $output   .= "\t".$tag."\n";
                                   }
                              }else{
                                   $output   .= "\t".$this->head[$group]."\n";
                              }
                              $output   .= "\n";
                         }
                    }
               }

               return $output;

          }

     }

?>
