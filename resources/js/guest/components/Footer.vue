<template>
  
    <footer>

        <div class="top d-flex flex-wrap p-2">

            <div class="top-left d-flex align-items-center justify-content-md-around justify-content-sm-between col-md-6 col-sm-12">
                
                <div class='col-auto'>

                    <div class="lang mb-1">
                        <a class='no-link' href="#">
                            <span>Italiano</span>
                            <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>

                    <div class='site-logo'>
                        <a href="#">
                            <img class="d-none d-sm-inline" src="../../../../public/img/logo_inverted.png" alt="">
                            <img class="d-inline d-sm-none" src="../../../../public/img/logo_inverted_B.png" alt="">
                        </a>
                    </div>
                </div>

                
                <div class="contacts col-auto">
                    <ul>
                        <li><label><i class="fa fa-envelope" aria-hidden="true"></i></label> <a href="mailto:bdoctor.sfobs@example.it">bdoctor.sfobs@example.it</a></li>
                        <li><label><i class="fas fa-map-location-dot"></i></label> Vi(c)olino S. Barbi 51, Firenze (FI)</li>
                    </ul>
                </div>
            </div>

            <div class="top-right d-flex align-items-center justify-content-lg-end my-sm-3 col-md-6 col-sm-12">

                <section class="social-links col-3 d-flex justify-content-between">

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

                <section class='site-logo'>

                </section>
            </div>
        </div>

        <div class="bottom d-flex align-items-center justify-content-center">
            
            <p>&copy; 2022 - Tutti i diritti riservati –
                <abbr title="Boolean Doctors">BDoctor</abbr>, <abbr title="Salvalaggio Ficuciello Osnago Barbi Sannicola">SFOBS#51</abbr>
            </p>
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
    
        .top {
            background-color: $ms_blue;
            min-height: 150px;
            margin: 0 auto;

            .contacts {
                color: #bbb;

                ul {
                    margin: 0;
                    padding: 0;

                    li {
                        margin: 3px 0;
                    }
                }
            }

            .lang {
                color: #222;
                padding: 0;
            }
        }

        .bottom {
            padding: 0.5rem;
            text-align: center;
            width: 100%;
            background-color: $ms_yellow_dark;

            p {
                margin: 0;
                padding: 0;
            }   
        }

        ul {
            list-style-type: none;
        }

        abbr {
            font-weight: bold;
            color: $ms_blue;
        }

        label {
            font-weight: bolder;
            padding: 0;
            margin-right: 5px;
        }

        .social-links i:hover, a:hover {
            color: $ms_yellow;
            transform: translate(-1px, -1px);
        }

        .social-links {
            i {
                font-size: 1.5rem;
                margin: 0 3px;
            }
        }

        a.no-link {
            color: inherit;
            text-decoration: none;
        }

        a {
            text-decoration: none;
        }
    }

    



</style>