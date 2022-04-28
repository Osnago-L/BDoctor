<template>
  
    <footer class='m-0-auto'>

        <div class="top">

            <div class="top left d-flex col-md-7 col-sm-12">

                <ul>
                    <li>Email:</li>
                    <a href="mailto:bdoctors.sfobs@example.it">bdoctors.sfobs@example.it</a>

                </ul>

                <div class="lang">
                    <img src="img/ita.png" alt="">
                    <span>Italiano</span>
                    <i class="fa fa-chevron-down"></i>
                </div>
                
            </div>

            <div class="top right d-flex col-md-5 col-sm-12">

                <section class="social-links">

                    <a href="#" class='link-box'>
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class='link-box'>
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class='link-box'>
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class='link-box'>
                        <i class="fab fa-youtube"></i>
                    </a>
                </section>
            </div>
        </div>

        <div class="bottom">
            <p>&copy; 2022 - All right reserved <br/> 
            <abbr title="Salvalaggio Ficuciello Osnago Barbi Sannicola">SFOBS</abbr>, <abbr title="Boolean Doctors">BDoctor</abbr></p>
        </div>

    </footer>

</template>

<script>
export default {
    name: "Footer"
}
</script>

<style lang='scss' scoped>

    @import "../../../sass/guest/_variables.scss";

    footer {
        width: 100%;
        
    }

    footer.bottom {
        height: 100px;
        text-align: center;
    }

    footer.top {
        background-color: #184370;
        height: 200px;
        width: 100%;
    }

</style>