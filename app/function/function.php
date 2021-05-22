<?php 

function PIPHP_GoogleTranslate($text, $lang1, $lang2) 
{ 
   $langs = array( 
      'arabic'              => 'ar', 
      'bulgarian'           => 'bg', 
      'simplified chinese'  => 'zh-cn', 
      'traditional chinese' => 'zh-tw', 
      'croatian'            => 'hr', 
      'czech'               => 'cs', 
      'danish'              => 'da', 
      'dutch'               => 'nl', 
      'english'             => 'en', 
      'finnish'             => 'fi', 
      'french'              => 'fr', 
      'german'              => 'de', 
      'greek'               => 'el', 
      'hindi'               => 'hi', 
      'italian'             => 'it', 
      'japanese'            => 'ja', 
      'korean'              => 'ko', 
      'polish'              => 'pl', 
      'portuguese'          => 'pt', 
      'romanian'            => 'ro', 
      'russian'             => 'ru', 
      'spanish'             => 'es',
      'vietnamese'          => 'vi', 
      'swedish'             => 'sv'); 
    $lang1 = strtolower($lang1); 
   $lang2 = strtolower($lang2); 
//    dd($lang2);

   $root  = 'http://ajax.googleapis.com/ajax/services'; 
   $url   = $root . '/language/translate?v=1.0&q='; 
    
   if (!isset($langs[$lang1]) || !isset($langs[$lang1])) 
      return FALSE; 
 
   $json = @file_get_contents($url . urlencode($text) . 
           '&langpair='. $langs[$lang1] . '%7C' . 
           $langs[$lang2]); 

   if (!strlen($json)) return FALSE; 
    
   $result = json_decode($json); 
   return $result->responseData->translatedText; 
 }
  //nối chuỗi php '..' - javascript ' ++ ' 
  //đệ quy category = = 

  function showCategories($categories, $parent_id = 0, $char = '')
  {
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              showCategories($categories, $item->id, $char.'--');
          }
      }
  }
  function showEditProductCategories($categories, $parent_id = 0, $char = '')
  {
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              showEditProductCategories($categories, $item->id, $char.'--');
          }
      }
  }
    function showProductCategories($categories, $parent_id = 0, $char = '')
  {
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo ' <input type="checkbox" name="parent_id" value="'.$item->id.'"><option style="display:inline-block" value="'.$item->id.'">'.$char.$item->name.'</option><br>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              showProductCategories($categories, $item->id, $char.'--');
          }
      }
  }


  function tableCategories($categories, $parent_id = 0, $char = '')
  {
     $stt=1;
      foreach ($categories as $key => $item)
      {
          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          {
              echo '<tr >';
                  echo '<td scope="col" class="checkbox1"><input type="checkbox"  class="checkbox"  data-id='.$item->id.' ></td>';
                  echo '<td scope="col" class="stt">'.$stt++.'</td>';
                  echo '<td scope="col">'.substr($char.$item->name,0,30).'</td>';
                  echo '<td scope="col">'.substr($item->desc,0,20).'</td>';
                  echo '<td scope="col" >'.$item->parent_name.'</td>';
                  // echo '<td scope="col">'.$item->media_id.'</td>';
                  echo '<td scope="col" class="text-center" class="tacvu"><a target="_blank" rel="noopener noreferrer" href="'.route('home.list.category.post',['id'=>$item->id]).'"><i class="fas fa-eye"></i></a>
                    <a href="'.route('edit.category.post',['id'=>$item->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category.post',['id'=>$item->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
              echo '</tr>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              tableCategories($categories, $item->id, $char.'--');
          }
      }
  }
  function tableCategoriesAll($categories, $parent_id = 0, $char = '')
  {
    
           $stt = 1;
              
          foreach ($categories as $key => $item)
      {

          // Nếu là chuyên mục con thì hiển thị
          if ($item->parent_id == $parent_id)
          { 
              echo '<tr >';
                  // echo '<input type="hidden" name="type" id="type" value='.$item->type.'>';
                  echo '<td scope="col" class="checkbox1"><input type="checkbox"  class="checkbox"  data-id='.$item->id.' ></td>';
                  echo '<td scope="col" class="stt">'. $stt++ .'</td>';
                  echo '<td scope="col">'.substr($char.$item->name,0,30).'</td>';
                  echo '<td scope="col">'.substr($item->desc,0,20).'</td>';
                  echo '<td scope="col" >'.$item->parent_id.'</td>';
                  // echo '<td scope="col">'.$item->media_id.'</td>';
                  echo '<td scope="col" class="text-center" class="tacvu">
                    <a href="'.route('edit.category',['id'=>$item->id,'type'=>$item->type]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category',['id'=>$item->id,'type'=>$item->type]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
              echo '</tr>';
              // Xóa chuyên mục đã lặp
              unset($categories[$key]);
               
              // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
              tableCategoriesAll($categories, $item->id, $char.'--');
          }
      }
    }
    function tableProductCategories($categories, $parent_id = 0, $char = '')
    {

       $stt=1;

        foreach ($categories as $key => $item)
        {

            if ($item->parent_id == $parent_id)
            {
              if($item->parent_id == $item->id){
                $name = $item->name;
              }
                echo '<tr >';
                    echo '<td scope="col" class="checkbox1"><input type="checkbox" class="checkbox" data-id='.$item->id.'></td>';
                    echo '<td scope="col" class="stt">'.$stt++.'</td>';
                    echo '<td scope="col">'.substr($char.$item->name,0,30).'</td>';
                    if(asset($item->url)) {
                      echo '<td scope="col" ><img style="width:50px; height:50px;" src="'.asset('Media/'.$item->url.'').'"></td>';
                    } else {
                      echo '<td scope="col" ><img style="width:50px; height:50px;"></td>';
                    }
                    
                    echo '<td scope="col">'.substr($item->desc,0,20).'</td>';
                    echo '<td scope="col" >'.$item->parent_name.'</td>';
                    // echo '<td scope="col">'.$item->media_id.'</td>';
                    echo '<td scope="col" class="text-center"><a target="_blank" rel="noopener noreferrer" href="'.route('get.list.product',['id'=>$item->id]).'"><i class="fas fa-eye"></i></a><a href="'.route('edit.category.product',['id'=>$item->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category.product',['id'=>$item->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
                echo '</tr>';
                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                tableProductCategories($categories, $item->id, $char.'--');
            }
        }
      }
  //  function tableProductCategories($categories, $parent_id = 0, $char = '')
  // {
  //    $stt=1;
  //     foreach ($categories as $key => $item)
  //     {
  //         // Nếu là chuyên mục con thì hiển thị
  //         if ($item->parent_id == $parent_id)
  //         {
  //             echo '<tr>';
  //                 echo '<td scope="col"><input type="checkbox"  name=""></td>';
  //                 echo '<td scope="col">'.$stt++.'</td>';
  //                 echo '<td scope="col">'.$char.$item->name.'</td>';
  //                 echo '<td scope="col">'.$item->desc.'</td>';
  //                 echo '<td scope="col">'.$item->parent_id.'</td>';
  //                 echo '<td scope="col">'.$item->media_id.'</td>';
  //                 echo '<td scope="col"><a href="'.route('edit.category',['id'=>$item->id]).'"><i class="fa fa-edit tacvu"></i></a><a href="'.route('delete.category',['id'=>$item->id]).'" onclick="return confirm(\'bạn có chắc muốn xóa không ?\')"><i class="fa fa-trash tacvu" style="color: red"></i></a></td>';
  //             echo '</tr>';
  //             // Xóa chuyên mục đã lặp
  //             unset($categories[$key]);
               
  //             // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
  //             tableCategories($categories, $item->id, $char.'**');
  //         }
  //     }
  // }
?>