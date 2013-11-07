 <?php 
  class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('pusp.sqlite');
      }
   }
   $db = new MyDB();
  
  //INSERT Operation
  $name=$_POST['name'];
  $star=$_POST['star'];
  $amount=$_POST['amount'];
  $pooja=$_POST['pooja'];
  $age=$_POST['age'];
   $sql =<<<EOF
      INSERT INTO vazhipadu(name,star,amount,pooja,age)
      VALUES('$name','$star','$amount','$pooja','$age');

      
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Records created successfully\n";
   }
    
   ?>
