<?php
include 'DBconnection.php';

$id = $_POST['id'];

$sql = 'update FROM user WHERE id = ?';
$res = $conn->prepare($sql);
$res->bind_params('i', $id);
$res->execute();

// <!DOCTYPE html>
// <html>
//   <head>
// <meta name="viewport" content="width=device-width, initial-scale=1.0">
// <link rel="stylesheet"  href="style.css"> 
//  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
//    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
// <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
// <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
// <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
// <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
// </head>
// <body>
  
//     <div class="container11">
//         <h1 class="w3-padding-32 w3-center">Update user details</h1>
// <form method="post" action="update.php" >


      
//   <div class="input-group1">
//   <label for="username">Username</label>
//      <input type="text" name="username" placeholder="Enter username" id="username" value="" required>
        
      
//   </div> 
//   <br>	
//   <div class="input-group1"> 
//         <label for="email">Email Id</label>
//         <input type="email" id="email" name="email" placeholder="Enter your Email" value="" required>
//         <span id='message2'></span>
//   </div> 
//   <br>
//   <div class="input-group1">
//   <label for="fname">Name</label>
//      <input type="text" name="name" placeholder="Enter name" id="name" value="" required>
     

      
//   </div>    
//    <br><br>  
  
//   <div class="input-group1">
//           <label for="date">Date  of Birth</label> 
//         <input type="date" name="date" placeholder="Choose Date of Birth" id="date" min="1950-01-01" value="" required>

//   </div>

//   <br><br><br>

//   <div class="input-group1">
//           <label for="address">Address</label>
//         <textarea name="address"  placeholder="Enter Address" id="address" rows="3" cols="50" value="" required> </textarea>

//   </div>
//   <br>
    
//   <div class="input-group1"> 
//         <label for="password1">Password</label>
//         <input type="password" id="password1" name="password1" placeholder="Enter your password" value="" required>
//         <span id='message3'></span>
//   </div> 
// <br>
// <div class="input-group1"> 
//         <label for="password2">Confirm Password</label>
//         <input type="password" id="password2" name="password2" placeholder="Retype password" value="" required>
//         <br>
//         <span id='message3'></span>
//   </div> 
//   <br>
//   <div class="input-group1">
//     <input type="submit" class="btn" name="reg_user" id="enter" disabled="true" value="Update Details">
//   </div>

// </form>
// <script>
//             $('#password1, #password2').on('keyup', function () {
//               if ($('#password1').val() == $('#password2').val()) 
//                {
//                             $('#message3').html('Matched').css('color', 'green');
//                             $("#enter").prop('disabled',false);
//                } 
//                else 
//                             $('#message3').html('Password Missmatch').css('color', 'red');
//                }
//                );
//       </script>
// <script>
//       $('#email').on('keyup',function(){
//                 var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//                 var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
//                 var email = $("#email").val();
//                 if(email.match(mailformat)){
//                     $('#message2').html('valid').css('color','green');
//                 }
//                 else
//                     $('#message2').html('Invalid Email').css('color','red');
                    
//             }
//             );
//   </script>
    
//   </div>
 

// </body>
// </html>