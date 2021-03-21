<style>
    .social-links{
    display: flex;
    padding: 5%;
    justify-content: space-between;
}

.social-links section{
    flex-basis: 30%;
}

.social-icons-footer i{
    font-size: 37px;
    padding: 5px; 
}

.instagram img{
    padding: 5px;
}

.footer-button{
    display: block;
    border: 1px solid rgb(35, 35, 192);
    color: 2196f3;
    font-size: 14px;
    font-weight: bolder;
    background-color: white;
    margin: 20px auto;
    padding: 10px 20px;
    cursor: pointer;
}

.footer-button:hover{
    color: white;
    background-color: blue;
}

.copyright{
    width: 100%;
    background-color: black;
    color: white;
    padding: 5px;
    text-align: center;
}

/* html, body {
  height: 100%;
  margin: 0;
} */
.full-height {
  height: 100%;
}
</style>

<html>
    <body>
        <div class="full-height">
        <div class="social-links " style="background-color: rgb(231, 231, 245)" id="about">
            <section class="about">
                <h2>About</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta perspiciatis veritatis illum ratione voluptatibus odit sit quos sunt, velit ipsam.</p>
                <div class="social-icons-footer">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-google-plus-g"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fas fa-rss-square"></i>
                    <i class="fab fa-pinterest-square"></i>
                    <i class="fab fa-linkedin"></i>
                </div>
            </section>
            
        </div>
        <div class="copyright">Copyright @ 2021 Social Blog</div>
    </div>
    </body>
</html>