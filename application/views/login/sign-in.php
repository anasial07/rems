<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<title>Sign in | REMS</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }
        body,
        input {
            font-family: 'Montserrat', sans-serif;
        }
        .container {
            position: relative;
            width: 100%;
            background-color: #fff;
            min-height: 100vh;
            overflow: hidden;
        }
        .forms-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .signin-signup {
            position: absolute;
            top: 45%;
            transform: translate(-50%, -50%);
            left: 75%;
            width: 50%;
            transition: 1s 0.7s ease-in-out;
            display: grid;
            grid-template-columns: 1fr;
            z-index: 5;
        }
        .sign-up-form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0rem 5rem;
            transition: all 0.2s 0.7s;
            overflow: hidden;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }
        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0rem 5rem;
            transition: all 0.2s 0.7s;
            overflow: hidden;
            grid-column: 1 / 2;
            grid-row: 1 / 2;
        }
        .sign-up-form {
            opacity: 0;
            z-index: 1;
        }
        form.sign-in-form {
            z-index: 2;
        }
        .title {
            font-size: 1.9rem;
            color: #444;
            margin-bottom: 10px;
        }
        .input-field {
            max-width: 380px;
            width: 100%;
            background-color: #f0f0f0;
            margin: 10px 0;
            height: 55px;
            border-radius: 5px;
            display: grid;
            grid-template-columns: 15% 85%;
            padding: 0 0.4rem;
            position: relative;
        }
        .input-field i {
            text-align: center;
            line-height: 55px;
            color: #acacac;
            transition: 0.5s;
            font-size: 1.1rem;
        }
        .input-field input {
            background: none;
            outline: none;
            border: none;
            line-height: 1;
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        .input-field input::placeholder {
            color: #aaa;
            font-weight: 500;
        }
        .social-text {
            padding: 0.7rem 0;
            font-size: 1rem;
        }
        .social-media {
            display: flex;
            justify-content: center;
        }
        .social-icon {
            height: 46px;
            width: 46px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 0.45rem;
            color: #333;
            border-radius: 50%;
            border: 1px solid #333;
            text-decoration: none;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .social-icon:hover {
            color: #F86F03;
            border-color: #F86F03;
        }
        .btn {
            width: 150px;
            background-color: #F86F03;
            border: none;
            outline: none;
            height: 49px;
            border-radius: 4px;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
            margin: 10px 0;
            cursor: pointer;
            transition: 0.5s;
        }
        .btnSignin, .forgotBtn {
            text-transform: uppercase;
            font-weight: 600;
            color: #fff;
            transition: 0.5s;
            cursor: pointer;
            border: none;
            outline: none;
            background-color: #F86F03;
            max-width: 380px;
            width: 100%;
            margin: 10px 0;
            height: 55px;
            border-radius: 5px;
            display: grid;
            grid-template-columns: 15% 85%;
            padding: 0 0.4rem;
            position: relative;
        }
        .btn:hover {
            background-color: #f98c39;
        }
        .panels-container {
            position: absolute;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }
        .container:before {
            content: "";
            position: absolute;
            height: 2000px;
            width: 2000px;
            top: -10%;
            right: 48%;
            transform: translateY(-50%);
            background-image: linear-gradient(-45deg, #F86F03 0%, #FFA41B 100%);
            transition: 1.8s ease-in-out;
            border-radius: 50%;
            z-index: 6;
        }
        .image {
            width: 100%;
            transition: transform 1.1s ease-in-out;
            transition-delay: 0.4s;
        }
        .panel {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-around;
            text-align: center;
            z-index: 6;
        }
        .left-panel {
            pointer-events: all;
            padding: 3rem 17% 2rem 12%;
        }
        .right-panel {
            pointer-events: none;
            padding: 3rem 12% 2rem 17%;
        }
        .panel .content {
            color: #fff;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.6s;
        }
        .panel h3 {
            font-weight: 600;
            line-height: 1;
            font-size: 1.5rem;
        }

        .panel p {
            font-size: 0.95rem;
            padding: 0.7rem 0;
        }
        .btn.transparent {
            margin: 0;
            background: none;
            border: 2px solid #fff;
            width: 130px;
            height: 41px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .right-panel .image,
        .right-panel .content {
            transform: translateX(800px);
        }
        /* ANIMATION */
        .container.sign-up-mode:before {
            transform: translate(100%, -50%);
            right: 52%;
        }
        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateX(-800px);
        }
        .container.sign-up-mode .signin-signup {
            left: 25%;
        }
        .container.sign-up-mode .sign-up-form {
            opacity: 1;
            z-index: 2;
        }
        .container.sign-up-mode form.sign-in-form {
            opacity: 0;
            z-index: 1;
        }
        .container.sign-up-mode .right-panel .image,
        .container.sign-up-mode .right-panel .content {
            transform: translateX(0%);
        }
        .container.sign-up-mode .left-panel {
            pointer-events: none;
        }
        .container.sign-up-mode .right-panel {
            pointer-events: all;
        }
        @media (max-width: 870px) {
        .container {
            min-height: 800px;
            height: 100vh;
        }
        .signin-signup {
            width: 100%;
            top: 95%;
            transform: translate(-50%, -100%);
            transition: 1s 0.8s ease-in-out;
        }
        .signin-signup,
        .container.sign-up-mode .signin-signup {
            left: 50%;
        }
        .panels-container {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 2fr 1fr;
        }
        .panel {
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 2.5rem 8%;
            grid-column: 1 / 2;
        }
        .right-panel {
            grid-row: 3 / 4;
        }
        .left-panel {
            grid-row: 1 / 2;
        }
        .image {
            width: 200px;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.6s;
        }
        .panel .content {
            padding-right: 15%;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.8s;
        }
        .panel h3 {
            font-size: 1.2rem;
        }
        .panel p {
            font-size: 0.7rem;
            padding: 0.5rem 0;
        }
        .btn.transparent {
            width: 110px;
            height: 35px;
            font-size: 0.7rem;
        }
        .container:before {
            width: 1500px;
            height: 1500px;
            transform: translateX(-50%);
            left: 30%;
            bottom: 68%;
            right: initial;
            top: initial;
            transition: 2s ease-in-out;
        }
        .container.sign-up-mode:before {
            transform: translate(-50%, 100%);
            bottom: 32%;
            right: initial;
        }
        .container.sign-up-mode .left-panel .image,
        .container.sign-up-mode .left-panel .content {
            transform: translateY(-300px);
        }
        .container.sign-up-mode .right-panel .image,
        .container.sign-up-mode .right-panel .content {
            transform: translateY(0px);
        }
        .right-panel .image,
        .right-panel .content {
            transform: translateY(300px);
        }
        .container.sign-up-mode .signin-signup {
            top: 5%;
            transform: translate(-50%, 0);
        }
    }
    @media (max-width: 570px) {
        form {
            padding: 0 1.5rem;
        }

        .image {
            display: none;
        }
        .panel .content {
            padding: 0.5rem 1rem;
        }
        .container {
            padding: 1.5rem;
        }

        .container:before {
            bottom: 72%;
            left: 50%;
        }

        .container.sign-up-mode:before {
            bottom: 28%;
            left: 50%;
        }
    }
    </style>
</head>
<body>
	<div class="container">
		<div class="forms-container">
			<div class="signin-signup">
				<form action="<?= base_url('login/signin'); ?>" method="post" class="sign-in-form">
                    <center>
                        <img width="100" src="<?= base_url('assets/img/favicon.png'); ?>">
                    </center>
					<h2 class="title">Sign in to your <span style="color:#F97908;">account</span></h2>
                    <?php if($failed = $this->session->flashdata('failed')): ?>
                        <div style="color:red;"><?= $failed; ?></div>
                    <?php endif; ?>
					<div class="input-field">
						<i class="fas fa-envelope"></i>
						<input name="useremail" type="text" placeholder="Official email" required>
					</div>
					<div class="input-field">
						<i class="fas fa-lock"></i>
						<input autocomplete="off" name="userPass" type="password" placeholder="Password" required>
					</div>
					<input type="submit" value="Sign in" class="btnSignin solid">
					<p class="social-text">Or Sign in with social platforms</p>
					<div class="social-media">
						<a href="#" class="social-icon">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-google"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</form>
				<div class="sign-up-form">
                    <span id="mailImg"></span>
					<h2 class="title">Forgot Password</h2>
					<div class="input-field" id="mailInput">
						<i class="fas fa-envelope"></i>
						<input autocomplete="off" type="email" id="forgotEmail" placeholder="Official email">
					</div>
					<input onclick="forgot()" type="submit" id="forgotBtn" class="forgotBtn" value="Submit Request"/>
					<p class="social-text" id="responseMsg">Enter your email and we will send you a new<br>password on your email</p>
					<br><div class="social-media">
						<a href="#" class="social-icon">
							<i class="fab fa-facebook-f"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-twitter"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-google"></i>
						</a>
						<a href="#" class="social-icon">
							<i class="fab fa-linkedin-in"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="panels-container">
			<div class="panel left-panel">
				<div class="content">
					<h3>Recover my account</h3>
					<p>Restore access to my account with secure authentication. Verify and recover my credentials for seamless login and continued connection.</p>
					<button class="btn transparent" id="sign-up-btn">
						Recover
					</button>
				</div>
				<img  src="https://i.ibb.co/6HXL6q1/Privacy-policy-rafiki.png" class="image" alt="" />
			</div>
			<div class="panel right-panel">
				<div class="content">
					<h3>One of Our Valued Members</h3>
					<p>Thank you for being part of our community. Your presence enriches our shared experiences. Let's continue this journey together!</p>
					<button class="btn transparent" id="sign-in-btn">
						Sign in
					</button>
				</div>
				<img src="https://i.ibb.co/nP8H853/Mobile-login-rafiki.png"  class="image" alt="" />
			</div>
		</div>
	</div>
    <script type="text/javascript">
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".container");
        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });
        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
        function forgot(){
            var forgotEmail = document.getElementById("forgotEmail").value;
            $.ajax({
                url: "<?php echo base_url('login/reset_password'); ?>",
                type: "POST",
                data: { email: forgotEmail },
                cache: false,
                success: function(dataResult){
                    if(dataResult == true){
                        document.getElementById("mailInput").style.display="none";
                        document.getElementById("forgotBtn").style.display="none";
                        document.getElementById("mailImg").innerHTML='<img src="<?= base_url("assets/img/icon/mail.gif"); ?>" width="200">';
                        document.getElementById("responseMsg").innerHTML="<span style='color:green;'>We have sent you a new password, check your email.</span>";
                    }else{
                        document.getElementById("responseMsg").innerHTML="<span style='color:red;'>The email you entered does not exist on our database.<br>Try using another one.</span>";
                    }
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
</html>