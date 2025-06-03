<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Drupal Coder</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <script src="js/form.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link
      rel="stylesheet"
      type="text/css"
      href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <script
      type="text/javascript"
      src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"
    ></script>

    <script src="js/gallery.js" defer></script>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="styleSlider.css" />
    
  </head>
  <body>

    <div class="video-back">
      <div class="video">
        <video autoplay muted loop id="my-video">
          <source src="img/video.mp4" type="video/mp4">
        </video>
      </div>
    </div>

    <div class="container content-video">
      <nav class="navbar navbar-expand-md mb-md-4 navbar-dark"> 
        <div class="container-fluid">
          <div class="header__logo">
            <img src="img/drupal-coder.svg" alt="Логотип сайта" style="width: 100%">
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav mb-2 mb-md-0 navbar-right">
              <li class="nav-item">
                <a class="nav-link text-white" href="#">ПОДДЕРЖКА DRUPAL</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  АДМИНИСТРИРОВАНИЕ
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">МИГРАЦИЯ</a></li>
                  <li><a class="dropdown-item" href="#">БЭКАПЫ</a></li>
                  <li><a class="dropdown-item" href="#">АУДИТ БЕЗОПАСНОСТИ</a></li>
                  <li><a class="dropdown-item" href="#">ОПТИМИЗАЦИЯ СКОРОСТИ</a></li>
                  <li><a class="dropdown-item" href="#">ПЕРЕЕЗД НА HTTPS</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">РЕКЛАМА</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  О НАС
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item text-white" href="#">КОМАНДА</a></li>
                  <li><a class="dropdown-item text-white" href="#">DRUPALGIVE</a></li>
                  <li><a class="dropdown-item text-white" href="#">БЛОГ</a></li>
                  <li><a class="dropdown-item text-white" href="#">КУРСЫ DRUPAL</a></li>
                  <li><a class="dropdown-item text-white" href="#">ПЕРЕЕЗД НА HTTPS</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">ПРОЕКТЫ</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">КОНТАКТЫ</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      

      
      <div class="row">
        <div class="col-md-6">
          <h2 class="text-white mb-3">Поддержка <br> сайтов на Drupal</h2>
          <p id="p-head">Сопровождение и поддержка сайтов <br> на CMS Drupal любых версий и запущенности</p>
          <a href="#tarifs" style="text-decoration: none; color: inherit; ">
            <div id="button-tarif"><p id="button-tarif-p">ТАРИФЫ</p></div>
          </a>
        </div>
        <div class="col-md-6 col-12 mt-md-5">

          <div class="row">
            <div class="col-md-4 col-6 mb-5">
              <div class="vertical-border-head"></div>
              <h3 class="support-head-title" id="n-one">#1</h3>
              <img id="cup" src="img/cup.png">
              <p class="support-head-p">Drupal-разработчик <br> в России по версии Рейтинга Рунета</p>
            </div>
            <div class="col-md-4 col-6 mb-5">
              <div class="vertical-border-head"></div>
              <h3 class="support-head-title">3+</h3>
              <p class="support-head-p">средний опыт специалистов более <br> 3 лет</p>
            </div>
            <div class="col-md-4 col-6 mb-5">
              <div class="vertical-border-head"></div>
              <h3 class="support-head-title">14</h3>
              <p class="support-head-p">лет опыта в сфере <br> Drupal</p>
            </div>
          <!-- </div> -->

          <!-- <div class="row"> -->
            <div class="col-md-4 col-6 mb-5">
              <div class="vertical-border-head"></div>
              <h3 class="support-head-title">50+</h3>
              <p class="support-head-p">модулей и тем <br> в формате DrupalGive</p>
            </div>
            <div class="col-md-4 col-6 mb-5">
              <div class="vertical-border-head"></div>
              <h3 class="support-head-title">90 000+</h3>
              <p class="support-head-p">часов поддержки <br> сайтов на Drupal</p>
            </div>
            <div class="col-md-4 col-6 mb-5">
              <div class="vertical-border-head"></div>
              <h3 class="support-head-title">300+</h3>
              <p class="support-head-p">Проектов <br> на поддержке</p>
            </div>
          </div>

          </div>
        </div>
      </div>
    </div>
    



    <!--КОМПЕТЕНЦИИ-->   <!--ДОДЕЛАТЬ-->
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-12 mb-3"><h2>13 лет совершенствуем компетенции в Друпал поддержке!</h2></div>
      </div>
      <div class="row">
        <p class="col-md-6 col-12 mb-5 competency1-p">Разрабатываем и оптимизируем модули, расширяем функциональность сайтов, обновляем дизайн</p>
      </div>
      <div class="row">
        <div class="col-md-3 col-6">
          <img src="img/competency-1.svg">
          <p class="competency11-p col-8">Добавление <br> информации на сайт, <br> создание новых разделов</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-2.svg">
          <p class="competency11-p col-8">Разработка и  оптимизация модулей сайта</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-3.svg">
          <p class="competency11-p col-8">Интеграция с CRM, 1C, платежными системами, любыми веб-сервисами</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-4.svg">
          <p class="competency11-p col-8">Любые доработки функционала дизайна</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-5.svg">
          <p class="competency11-p col-8">Аудит и мониторинг безопасности Drupal сайтов</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-6.svg">
          <p class="competency11-p col-8">Миграция, импорт контента и апгрейд Drupal</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-7.svg">
          <p class="competency11-p col-8">Оптимизация и ускорение Drupal-сайтов</p>
        </div>
        <div class="col-md-3 col-6">
          <img src="img/competency-8.svg">
          <p class="competency11-p col-8">Веб-маркетинг, консультации и работы по SEO</p>
        </div>
        
      </div>
    </div>

    <!--Поддержка-->
    <section class="support">
      <div class="support__container">
          <h2 class="support__title">Поддержка от Drupal-coder</h2>

          <div class="support__cards">
              <div class="support__card-item support__card-item_1">
                  <div class="support__card-number">01.</div>
                  <h3 class="support__card-title">Постановка задачи по Email</h3>
                  <p class="support__card-description">
                      Удобная и привычная модель постановки задач, при которой задачи фиксируются и никогда не теряются.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_2">
                  <div class="support__card-number">02.</div>
                  <h3 class="support__card-title">Система Helpdesk – отчетность, прозрачность</h3>
                  <p class="support__card-description">
                      Возможность посмотреть все заявки в работе и отработанные часы в личном кабинете через браузер.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_3">
                  <div class="support__card-number">03.</div>
                  <h3 class="support__card-title">Расширенная техническая поддержка</h3>
                  <p class="support__card-description">
                      Возможность организации расширенной техподдержки с 6:00 до 22:00 без выходных.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_4">
                  <div class="support__card-number">04.</div>
                  <h3 class="support__card-title">Персональный менеджер проекта</h3>
                  <p class="support__card-description">
                      Ваш менеджер проекта  всегда в курсе текущего состояния проекта и в любой момент готов ответить на любые вопросы.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_5">
                  <div class="support__card-number">05.</div>
                  <h3 class="support__card-title">Удобные способы оплаты</h3>
                  <p class="support__card-description">
                      Безналичный расчет по договору или электронные деньги: WebMoney, Яндекс.Деньги, Paypal.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_6">
                  <div class="support__card-number">06.</div>
                  <h3 class="support__card-title">Работаем с SLA и NDA</h3>
                  <p class="support__card-description">
                      Работа в рамках соглашений о конфиденциальности и об уровне качетсва работ.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_7">
                  <div class="support__card-number">07.</div>
                  <h3 class="support__card-title">Штатные специалисты</h3>
                  <p class="support__card-description">
                      Надежные штатные специалисты, никаких фрилансеров.
                  </p>
              </div>
              
              <div class="support__card-item support__card-item_8">
                  <div class="support__card-number">08.</div>
                  <h3 class="support__card-title">Удобные каналы связи</h3>
                  <p class="support__card-description">
                      Консультации по телефону, скайпу, в месенджерах.
                  </p>
              </div>
          </div>
      </div>
    </section>
    
    <section class="examination">
      <div class="examination__container">
          <h2 class="examination__title">Экспертиза в Drupal, опыт 14 лет!</h2>

          <div class="examination__cards">
              <div class="examination__card-item">
                  Только системный подход – контроль версий, резервирование и тестирование!
              </div>

              <div class="examination__card-item">
                  Только Drupal сайты, не берем на поддержку сайты на других CMS!
              </div>

              <div class="examination__card-item">
                  Участвуем в разработке ядра Drupal и модулей на Drupal.org, разрабатываем <span class="examination__card-item_accent">свои модули Drupal</span>
              </div>

              <div class="examination__card-item">
                  Поддерживаем сайта на Drupal 5, 6, 7 и 8
              </div>
          </div>

          <img src="img/drupal_logo.svg" alt="" class="examination__background">

          <img src="img/laptop.png" alt="" class="examination__foreground">
      </div>
    </section>
    
    <!--Тарифы--> <!--ДОДЕЛАТЬ-->
    <div class="container" id="tarifs">
      <div class="row">
        <div class="col-12"><h2 class="text-center mb-4 mt-5">Тарифы</h2></div>
      </div>
      <div class="row">
        
        <div class="container">
          <div class="row">

            <div class="col-md-4 col-sm-12">
              <div class="card mb-4">
                <div class="card-body">
                  <h4 class="card-title">Стартовый</h4>
                  <hr>
                </div>
                <ul class="list-group list-group-flush tariff-list">
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg> Консультации и работы по SEO</li>
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg>Услуги дизайнера</li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>                  
                    </svg> Неиспользованные оплаченные часы переносятся на следующий месяц</li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>                  
                    </svg> Предоплата от 6 000 рублей в месяц</li>
                </ul>
                <div class="card-body text-center">
                  <a href="#form" class="btn tariff-btn col-12">СВЯЖИТЕСЬ С НАМИ!</a>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="card active-card mb-4">
                <div class="card-body">
                  <h4 class="card-title">Бизнес</h4>
                  <hr>
                </div>
                <ul class="list-group list-group-flush tariff-list">
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg> Консультации и работы по SEO</li>
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg>Услуги дизайнера</li>
                  <li class="list-group-item"><svg class="tariff-check" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg>Высокое время реакции - до 2 рабочих дней</li>
                    <li class="list-group-item"><svg class="tariff-check" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>                  
                    </svg> Неиспользованные оплаченные часы не переносятся</li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>                  
                    </svg> Предоплата от 30 000 рублей в месяц</li>
                </ul>
                <div class="card-body text-center">
                  <a href="#form" class="btn tariff-btn col-12">СВЯЖИТЕСЬ С НАМИ!</a>
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">
              <div class="card mb-4">
                <div class="card-body">
                  <h4 class="card-title">VIP</h4>
                  <hr>
                </div>
                <ul class="list-group list-group-flush tariff-list">
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg> Консультации и работы по SEO</li>
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg>Услуги дизайнера</li>
                  <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                  </svg>Максимальное время реакции - в день обращения</li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>                  
                    </svg> Неиспользованные оплаченные часы не переносятся</li>
                    <li class="list-group-item"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#f14d34" class="bi bi-check" viewBox="0 0 16 16">
                      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>                  
                    </svg> Предоплата от 270 000 рублей в месяц</li>
                </ul>
                <div class="card-body text-center">
                  <a href="#form" class="btn tariff-btn col-12">СВЯЖИТЕСЬ С НАМИ!</a>
                </div>
              </div>
            </div>

            
          </div>


      </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-0"></div>
        <div class="col-md-6 col-12">
          <p class="text-center" class="p-color-main-black">Вам не подходят наши тарифы? Оставьте заявку и мы предложим вам индивидуальные условия!</p>
        </div>
        <div class="col-md-3 col-0"></div>
      </div>
      <div class="row">
        <div class="col-12"><a href="" id="get-tariff">ПОЛУЧИТЬ ИНДИВИДУАЛЬНЫЙ ТАРИФ</a></div>
      </div>
    </div>

    <!--ДОДЕЛАТЬ-->
    <div class="container" id="competency2">
        <div class="row">
            <div class="col-12" id="prof-title"><h2>Наши профессиональные разработчики выполняют быстро любые задачи</h2></div>
        </div>

        <div class="row text-center">
            <div class="col-md-3 col-12">
                <img class="competency-img" src="img\competency-20.svg">
                <h2 class="competency-title">от 1ч</h2>
                <p class="col-12">Настройка события GA в интернет-магазине</p>
            </div>
            <div class="col-1"></div>
            <div class="col-md-3 col-12">
                <img class="competency-img" src="img\competency-21.svg">
                <h2 class="competency-title">от 20ч</h2>
                <p class="col-12">Разработка мобильной версии сайта</p>
            </div>
            <div class="col-1"></div>
            <div class="col-md-3 col-12">
                <img class="competency-img" src="img\competency-22.svg">
                <h2 class="competency-title">от 8ч</h2>
                <p class="col-12">Интеграция модуля оплаты</p>
            </div>
        </div>
    </div>


    <!--Команда-->
    <div class="container" id="team">
        <div class="row">
            <div class="col-12"><h2 id="team-title" class="text-center">Команда</h2></div>
            <div class="col-md-4 col-6">
                <img src="img\IMG_2472_0.jpg" class="text-center">
                <h5><strong>Сергей Синица</strong></h5>
                <p class="team p-color-main-black">Руководитель отдела веб-разработки, канд. техн. наук, заместитель директора</p>
            </div>
            <div class="col-md-4 col-6">
                <img src="img\IMG_2539_0.jpg" class="text-center">
                <h5><strong>Роман Агабеков</strong></h5>
                <p class="team p-color-main-black">Руководитель отдела DevOPS, директор</p>
            </div>
            <div class="col-md-4 col-6">
                <img src="img\IMG_2474_1.jpg">
                <h5><strong>Алексей Синица</strong></h5>
                <p class="team p-color-main-black">Руководитель отдела поддержки сайтов</p>
            </div>
            <div class="col-md-4 col-6">
                <img src="img\IMG_2522_0.jpg">
                <h5><strong>Дарья Бочкарёва</strong></h5>
                <p class="team p-color-main-black">Руководитель отдела продвижения, контекстной рекламы и контент-поддержки сайтов</p>
            </div>
            <div class="col-md-4 col-6">
                <img src="img\IMG_9971_16.jpg">
                <h5><strong>Ирина Торкунова</strong></h5>
                <p class="team p-color-main-black">Менеджер по работе с клиентами</p>
            </div>

        </div>
        <div class="col-12 text-center">
            <button type="button" class="btn">ВСЯ КОМАНДА</button>
        </div>
    </div>


    <!--ПОСЛЕДНИЕ КЕЙСЫ-->  <!--ДОДЕЛАТЬ МОБ ВЕРСИЮ-->
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="text-center mb-md-5 mb-4">Последние кейсы</h2>
        </div>
        <div class="row mb-md-4">
          <div class="col-md-4 col-12 mb-3">
            <a href="" class="case-link">
            <div class="case-card case-l">
              <img class="case-img" src="img/case1.jpeg"></img>
              <div class="case-text">
                <h5 class="case-title">Настройка кэширования данных. Апгрейд сервера. Ускорение работы сайта в 30 раз!</h5>
                <h6 class="case-date">04.05.2020</h6>
                <p class="case-p">Влияние скорости загрузки страниц сайта на отказы и конверсии. Кейс ускорения...</p>
              </div>
            </div>
            </a>
        </div>
          <div class="col-md-8 col-12 mb-3">
            <a href="" class="case-link">
            <div class="case-card">
              <div class="case-text">
                <h5 class="case-title-white">Использование отчетов <br> Ecommerce в Яндекс.Метрике</h5>
              </div>
              <img class="case-img" src="img/case2.jpeg">
            </div>
            </a>
          </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-12 mb-3">
          <a href="" class="case-link">
          <div class="case-card">
            <div class="case-text">
              <h5 class="case-title-white">Повышение конверсии страницы с формой заявки с применением <br> AB-тестирования</h5>
              <h6 class="case-date-white">24.01.2020</h6>
            </div>
            <img class="case-img" src="img/case3.png">
          </div>
          </a>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <a href="" class="case-link">
          <div class="case-card">
            <div class="case-text">
              <h5 class="case-title-white">Drupal 7: ускорение времени генерации страниц интернет-магазина на 32%</h5>
              <h6 class="case-date-white">25.09.2019</h6>
            </div>
              <img class="case-img" src="img/case4.jpeg">
          </div>
          </a>
        </div>
        <div class="col-md-4 col-12 mb-3">
          <a href="" class="case-link">
            <div class="case-card case-l">
              <div class="case-text">
                <h5 class="case-title">Обмен товарами и заказами интернет-магазинов на <br> Drupal 7 с 1С: Предприятие, МойСклад, Класс365</h5>
                <h6 class="case-date">22.08.2019</h6>
                <p class="case-p">Опубликован <a href="" style="text-decoration: none;">релиз модуля...</a></p>
              </div>
              <img class="case-img" src="img/case5.png">
            </div>
          </a>
        </div>
      </div>
      </div>
    </div>

    <!--ОТЗЫВЫ--> <!--ДОДЕЛАТЬ-->
    <section class="reviews">
      <div class="reviews__container">
          <h2 class="reviews__title">Отзывы</h2>

          <div class="reviews__cards">
              <div class="reviews__card-item reviews__card-item_active">
                  <img src="img/reviews/logo_0.png" alt="" class="reviews__card-logo">

                  <p class="reviews__card-text">
                      Долгие поиски единственного и неповторимого мастера на многострадальный сайт www.cielparfum.com, который был собран крайне некомпетентным программистом и раз в месяц стабильно грозил погибнуть, привели меня на сайт и, в итоге, к ребятам из Drupal-coder. И вот уже практически полгода как не проходит и дня, чтобы я не подвинялся и не порадовался своему везению! Починили все, что не работал - от поиска до отображения меню. Провели редизайн - не отходя от желаемого, но со своими существенными и качественными дополнениями. Осуществили ряд проектов - конкурсы, тесты и тд. А уж метких поинок и доработок - не счесть! И главное - все качественно и быстро (не взирая на не самый "быстрый" тариф). Есть вопросы - замечательный Алексей всегда подскажет, поддержит, отремонтирует и/или просто сделает с нуля. Есть задумка для реализации - замечательный Сергей обсудит и предложит идеальный вариант. Есть проблема - замечательные Надежда и Роман починят, поправят, сделают! Ребята доказали, что эта CMS - мощная и грамотная система управления. Надеюсь, что наше сотрудничество затянется надолго! Спасибо!!
                  </p>

                  <p class="reviews__card-author">
                      С уважением, Наталья Сушкова, руководитель Отдела веб-проектов Группы компаний "Си Эль парфюм" <a href="http://www.cielparfum.com/" class="reviews__card-author_link">http://www.cielparfum.com/</a>
                  </p>

                  <div class="reviews__card-pager">
                      <img src="img/reviews/arrow-left.svg" alt="" class="reviews__card-to-left">

                      <span class="reviews__card-current">01</span>
                      <span class="reviews__card-all">/ 08</span>
                      
                      <img src="img/reviews/arrow-right.svg" alt="" class="reviews__card-to-right">
                  </div>
              </div>

              <div class="reviews__card-item reviews__card-item_inactive-1"></div>

              <div class="reviews__card-item reviews__card-item_inactive-2"></div>
          </div>
      </div>
    </section>

    <!--С НАМИ РАБОТАЮТ-->  <!--ДОДЕЛАТЬ-->
    <div class="container" id="gallery">
      <div class="row">
        <div class="col-12 mt-4">
          <h2 class="text-center">С нами работают</h2>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-12 col-md-6 mb-4">
              <h5 class="text-md-center m-3">
                Десятки компаний доверяют нам самое ценное, что у них есть в
                интернете - свои сайты. Мы делаем все, чтобы наше сотрудничество
                было долгим.
              </h5>
            </div>
          </div>

          <div class="slider">
            <div class="sliderItem">
              <img class="slider-img" src="img/welimirLogo.jpg" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/armscomLogo.webp" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/infodayLogo.jpeg" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" id="seedLogo" src="img/seedsLogo.png" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" id="kubsuLogo" src="img/kubsuLogo.jpg" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/rastlLogo.png" />
            </div>
          </div>

          <div class="slider2">
            <div class="sliderItem">
              <img class="slider-img" src="img/backLogo.png" />
            </div>
            <div class="sliderItem">
              <img
                class="slider-img"
                id="agencyLogo"
                src="img/agencyLogo.webp"
              />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/stoutLogo.png" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/welimirLogo.jpg" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/armscomLogo.webp" />
            </div>
            <div class="sliderItem">
              <img class="slider-img" src="img/infodayLogo.jpeg" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--FAQ-->  <!--ДОДЕЛАТЬ-->
    <div class="container mt-md-5 mt-3">
        <div class="row">
            <div class="col-12"><h2 class="text-center">FAQ</h2></div>
        <div class="row">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <span class="accordion-number">1.&nbsp;</span> Кто непосредственно занимается поддержкой?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Сайты поддерживают штатные сотрудники ООО "Инитлаб", г. Краснодар, прошедшие специальное обучение
                            и имеющие опыт работы с Друпал от 4 до 15 лет: 8 web-разработчиков, 2 специалиста по SEO, 4 системных администратора.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span class="accordion-number">2.&nbsp;</span> Как организована работа поддержки?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem reiciendis molestiae a tempore dicta? Facere, harum repellat. Cupiditate, sit quaerat.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <span class="accordion-number">3.&nbsp;</span> Что происходит, когда не отработаны все предоплаченные часы за месяц?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus ex optio vero incidunt, nesciunt, officia dolores nostrum similique beatae officiis, autem numquam quae est reprehenderit obcaecati! Veniam doloribus dolorem repellendus?
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          <span class="accordion-number">4.&nbsp;</span> Что происходит, когда отработаны все предоплаченные часы за месяц?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, provident.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          <span class="accordion-number">5.&nbsp;</span> Как происходит оценка и согласование планируемого времени на выполнение заявок?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad fugiat voluptatem perferendis vitae neque officiis quod porro, magnam molestiae. Facilis!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          <span class="accordion-number">6.&nbsp;</span> Сколько программистов выделяется на проект?
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate eligendi dolorem est temporibus, neque sed animi ipsum atque iusto repellendus tempora quidem itaque asperiores vel!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          <span class="accordion-number">7.&nbsp;</span> Как подать заявку на внесение изменений на сайте?
                        </button>
                    </h2>
                    <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo, voluptatem fugit mollitia ex cupiditate officiis!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                          <span class="accordion-number">8.&nbsp;</span> В течение какого времени начинается работа по заявке?
                        </button>
                    </h2>
                    <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem, ipsum dolor sit amet consectetur adipisicing elit. In, explicabo?
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                          <span class="accordion-number">9.&nbsp;</span> В течение какого времени начинается работа по заявке?
                        </button>
                    </h2>
                    <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora quisquam officiis totam quidem ipsam. Repellendus, impedit. Eum rem, ea quam magni reprehenderit totam, corporis vel molestias ullam eligendi, expedita voluptatibus.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                          <span class="accordion-number">10.&nbsp;</span> В какое время работает поддержка?
                        </button>
                    </h2>
                    <div id="collapseTen" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae incidunt ex aut et harum. Assumenda aliquam minima atque est perferendis, labore eius voluptates at iste vero ex animi error dolores?
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                          <span class="accordion-number">11.&nbsp;</span> Подходят ли услуги поддержки, если необходимо произвести обновление ядра Drupal или модулей?
                        </button>
                    </h2>
                    <div id="collapseEleven" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe sunt deleniti dignissimos eos. Sed, unde ipsa est nihil amet officiis cupiditate tenetur facere ex voluptatibus, maiores iste porro atque suscipit quae beatae assumenda debitis totam veniam rem? Placeat, ex voluptates!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                          <span class="accordion-number">12.&nbsp;</span> Можно ли пообщаться со специалистом голосом или в мессенджере?
                        </button>
                    </h2>
                    <div id="collapseTwelve" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusantium neque animi ex sunt, fugiat repellendus, excepturi ipsum fuga possimus error obcaecati. Maxime ut, quas id maiores possimus sed accusamus commodi, aut inventore distinctio ex animi repellendus. Suscipit nihil non dolore itaque recusandae velit, accusantium dolor.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
    

    <!--форма и футер-->  <!--ДОДЕЛАТЬ-->
    
    <div id="form">
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-sm-12">
            <h2>Оставить заявку на поддержку сайта</h2>
            <p id="form-p">
              Срочно нужна поддержка сайта? Ваша команда не успевает справиться
              самостоятельно или предыдущий подрядчик не справился с работой?
              Тогда вам точно к нам! Просто оставьте заявку и наш менеджер с
              вами свяжется!
            </p>

            <img id="telephone-icon" src="img/telephone-icon.png" />
            <p id="contact-tel">8 800 222-26-73</p>
            <img id="envelope-icon" src="img/envelope-icon.png" />
            <p id="contact-email">
              <a href="info@drupal-coder.ru">info@drupal-coder.ru</a>
            </p>
          </div>
          <div class="col-md-2"></div>
          <div class="col-md-5 col-sm-6">
            <form id="supportForm" action="api.php" method="POST">
              <?php 
                require_once 'tokens.php';
                $csrfToken = generateCSRFToken();
              ?>
              <input type="hidden" name="csrf_token" value="<?= $csrfToken ?>">            
              <p>
                  <input class="col-12" name="name" type="text" required placeholder="Ваше имя">
              </p>

              <p>
                  <input class="col-12" name="tel" required placeholder="Телефон" type="tel">
              </p>

              <p>
                  <input class="col-12" name="email" required placeholder="E-mail" type="email">
              </p>

              <p>
                  <textarea class="col-12" name="message" required placeholder="Ваш комментарий"></textarea>
              </p>

              <p id="checkbox">
                  <input id="pdp" type="checkbox" name="contract" required>
                  <label for="pdp" id="pdp-label">
                      Отправляя заявку, я даю согласие на
                      <a href="">обработку своих персональных данных.</a>
                  </label>
              </p>

              <button type="submit" class="col-12" id="contact-us">СВЯЖИТЕСЬ С НАМИ</button>      
            </form>
      
            <div id="response-message" style="display: none; margin-top: 20px;"></div>
        </div>
            


            
            
        </div>
      </div>
    </div>

      <footer>
        <div class="container">
        <div id="inner-footer">
          <div id="social-net">
            <a href="">
              <div class="icon-container">
                <img src="img/facebook-icon.png" />
              </div>
            </a>

            <a href="">
              <div class="icon-container">
                <img src="img/vk-icon.png" />
              </div>
            </a>

            <a href="">
              <div class="icon-container">
                <img src="img/telegram-icon.png" />
              </div>
            </a>

            <a href="">
              <div class="icon-container">
                <img src="img/youtube-icon.png" />
              </div>
            </a>
          </div>

          <p>Проект ООО "Инитлаб", Краснодар, Россия.</p>
          <p>
            Drupal является зарегистрированной торговой маркой Dries Buytaert.
          </p>
        </div>
      </footer></div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
