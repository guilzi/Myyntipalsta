<?php

  // Aloitetaan istunnot.
  session_start();

  // Suoritetaan projektin alustusskripti.
  require_once '../src/init.php';

  // Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
  // lyhentynyt muotoon /tavara.
  $request = str_replace($config['urls']['baseUrl'],'',$_SERVER['REQUEST_URI']);
  $request = strtok($request, '?');

  // Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
  $templates = new League\Plates\Engine(TEMPLATE_DIR);


  // Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava
  // käsittelijä.
  switch ($request) {
    case '/':
    case '/tavarat':
      require_once MODEL_DIR . 'tavara.php';
      $tavarat = haeTapahtumat();
      echo $templates->render('tavarat',['tavarat' => $tavarat]);
      break;
    case '/tavara':
      require_once MODEL_DIR . 'tavara.php';
      $tavara = haeTapahtuma($_GET['id']);
      if ($tavara) {
        echo $templates->render('tavara',['tavara' => $tavara]);
      } else {
        echo $templates->render('tavaranotfound');
      }
      break;
      case '/lisaa_tili':
        if (isset($_POST['laheta'])) {
          $formdata = cleanArrayData($_POST);
          require_once CONTROLLER_DIR . 'tili.php';
          $tulos = lisaaTili($formdata);
          if ($tulos['status'] == "200") {
            echo $templates->render('tili_luotu', ['formdata' => $formdata]);
            break;
          }
          echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
          break;
        } else {
          echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
          break;
        }
        case "/kirjaudu":
          if (isset($_POST['laheta'])) {
            require_once CONTROLLER_DIR . 'kirjaudu.php';
            if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
            $_SESSION['user'] = $_POST['email'];
            header("Location: " . $config['urls']['baseUrl']);
            } else {
              echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
            }
          } else {
            echo $templates->render('kirjaudu', [ 'error' => []]);
          }
          break;
    default:
      echo $templates->render('notfound');
  }    

?> 