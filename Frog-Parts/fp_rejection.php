<?php 
  require("fp_page.php");  

  $formPage = new Page();
?>
<!DOCTYPE html>
<html>
    <head>
      <!--
      Frog Parts rejection page
      Author: Jonathan Kinney
      Date Created:  06/03/2025
      Date Modified: 06/03/2025

      Filename: fp_rejection.php
      -->
    <meta charset="utf-8" />
    <?php 
      $formPage->DisplayKeywords();
      $formPage->DisplayTitle();
      $formPage->DisplayStyles();
    ?>
    <style>
      body#frogRejection {
        background: #1a1a2e;
        color: #ffe6f0;
        font-family: 'Comic Sans MS', cursive, sans-serif;
        text-align: center;
        padding-top: 20vh;
        overflow: hidden;
      }

      body#frogRejection p {
        font-size: 2em;
        margin-bottom: 20px;
        animation: shamePulse 2s infinite;
      }

      @keyframes shamePulse {
        0%, 100% {
          transform: scale(1);
          color: #ffe6f0; }
        50% {
          transform: scale(1.1);
          color: #ff69b4;}
      }

      .sparkle {
        position: absolute;
        width: 10px;
        height: 10px;
        background: radial-gradient(circle, white 0%, transparent 70%);
        border-radius: 50%;
        animation: sparkleAnim 3s linear infinite;
        pointer-events: none;
      }

      @keyframes sparkleAnim {
        0% {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        100% {
            transform: translateY(-200px) scale(0.5);
            opacity: 0;
        }
      }
    </style>
    </head>
    <body id="frogRejection">
        <p>Frog Login Rejected</p>

        <script>
          for(let i = 0; i < 50; i++) {
            const sparkle = document.createElement('div');
            sparkle.classList.add('sparkle');
            sparkle.style.left = Math.random() * 100 + 'vw';
            sparkle.style.top = Math.random() * 100 + 'vh';
            sparkle.style.animationDuration = (2 + Math.random() * 2) + 's';
            sparkle.style.animationDelay = (Math.random() * 5) + 's';
            document.body.appendChild(sparkle);
          }
        </script>
    </body>
</html>