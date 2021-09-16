<?php include_once "header.php";?>
    <body>
        <div class="wrapper">
            <section class="form login">
                <header>Realtime Chat App</header>
                <form action="#">
                    <div class="error-txt"></div>  
                    
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name = "email" placeholder="Enter your email">
                    </div>

                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name = "password" placeholder="Enter your password">
                        <i class="fas fa-eye"></i>
                    </div>
                    
                    <div class="field button">
                        <input type="submit" value="Continue to Chat">
                    </div>
                </form>    
                <div class="link">No yet signup? <a href="index.php">Create your account now</a></div>
            </section>
        </div>
        <script src="javascript\pass-show-hide.js"></script>
        <script src="javascript\login.js"></script>
    </body>
    
</html>