    $(document).ready(function(){
     $("#reg").submit(function(){
          
         var ajx = $(this).serialize();
         
       $.ajax({
          url:"",
          method:"post",
          data:ajx,
          //dataType:"json",
          success: function(datal){

            alert(JSON.stringify(datal));
           // $("#aa").html(JSON.stringify(datal));

          }
       });return false;
       });
     
     
     $("#login").submit(function(){
          
         var ajx = $(this).serialize();
         
       $.ajax({
          url:"",
          method:"post",
          data:ajx,
          dataType:"json",
          success: function(datal)
          {
           
                if (datal.success == 1)
                {
                    alert(JSON.stringify(datal));
                    window.location.href="list.php";
                }else
                    {
                    alert((datal.error_mess));
                    }
          }
       });return false;
       });
     
     
     $(".invite").click(function(){
         var id = $(this).data('value');
       $.ajax({
          url:"",
          method:"post",
          data:{'id':id,action:'invite'},
          success: function(datal)
          {
           window.location.reload();
          }
       });
       });
     
     
     $(".accept").click(function(){
         var id = $(this).data('value');
       $.ajax({
          url:"",
          method:"post",
          data:{'id':id,action:'accept'},
          success: function(datal)
          {
           alert(datal);
           window.location.reload();
          }
       });
       });
     
    });


