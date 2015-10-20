<?php
    
    $artikels = array(
        
        array("titel" =>"Politie: '80.000 betogers in Brussel'", 
                         "inhoud" => "Aan het Brusselse Noordstation is de nationale betoging van start gegaan. Volgens de politie zijn 80.000 betogers onderweg naar het Zuidstation, volgens de vakbonden bijna 100.000. Daarbij probeerde een groep havenarbeiders al meteen van het uitgestippelde parcours af te wijken.

    In het Noordstation leiden medewerkers van Securail de betogers ordelijk naar de uitgangen. Alles verliep er vlot. Buiten verzamelden duizenden betogers van de drie grote vakbonden, ABVV, ACV en ACLVB om te starten aan de optocht richting Zuidstation. 

    Een groep van een honderdtal havenarbeiders probeerde aan het begin van de optocht, ter hoogte van de Financiëntoren, al van het parcours af te wijken. Een honderdtal agenten waren echter snel ter plaatse om de poging in de kiem te smoren. 

    De bonden riepen vooraf op om geen bommetjes te gooien, maar die raad wordt duidelijk genegeerd.",
                         "afbeelding" =>"img/betoging.jpg", 
                         "beschrijving" => "Kruimels vullen geen brooddoos!",),

    
     array("titel" => "Air France pakt 20 medewerkers aan na geweldpleging op directeurs", 
           "inhoud" => "Air France verdenkt een     twintigtal werknemers van betrokkenheid bij de schermutseling op het eigen hoofdkantoor, waarbij maandag twee bestuurders werden mishandeld. Dat meldt de Franse zender RTL, zonder daarbij een bron te vermelden. </br>

    Tegen drie mensen die personeelschef Xavier Broseta en zijn mededirecteur Pierre Plissonnier daadwerkelijk zouden hebben gemolesteerd, is aangifte gedaan. Maar een intern onderzoek heeft nog circa twintig namen opgeleverd van mensen die zich zouden hebben misdragen . </br>", 
           "afbeelding" => "img/geweldpleging.jpg", 
           "beschrijving" => "Enkele topmannen van Air France werden deze week belaagd nadat bekendgemaakt was dat de luchtvaartmaatschappij bijna 3.000 jobs zou schrappen.",),


    array("titel" => "Opnieuw topjob voor oud-student Antwerpse Modeacademie", 
          "inhoud" => "Balenciaga heeft een nieuw creatief directeur aangeduid. De Georgiër Demna Gvasalia, oud-student van de Antwerpse Modeacademie die de voorbije seizoenen furore maakte met het label Vetements, wordt de opvolger van Alexander Wang. </br>

Balenciaga zei bij het aangekondigd afscheid van Wang meteen dat ze als vervanger niet opnieuw voor een grote naam zouden kiezen, maar op zoek gingen naar ‘onbekend talent’. En dat hebben ze gevonden bij Demna Gvasalia, toch wel een gedurfde keuze. </br>

‘We wilden iemand met een visie, iemand die de kaarten kan herschikken’, vertelde Isabelle Guichot, ceo van Balenciaga, aan Women’s Wear Daily. ‘Ik was onder de indruk van zijn benadering om het label te ontwikkelen, het was nieuw en erg persoonlijk.’ </br>

De 34-jarige Gvasalia studeerde in 2006 af aan de Antwerpse Modeacademie en werkte onder meer bij Walter Van Beirendonck alvorens hij in 2009 werd binnengehaald bij Maison Margiela, waar hij verantwoordelijk werd voor de vrouwencollecties. </br>

In 2013 maakte hij de overstap naar Louis Vuitton, om een jaar later zijn eigen label uit de grond te stampen waar hij conceptuele mode een nieuwe invulling geeft. Dat deed hij niet alleen, Vetements wordt voorgesteld als een collectief designers, maar Gvasalia en zijn broer zijn wel de eigenaars. </br>", 
          "afbeelding" => "img/mode.jpg", 
          "beschrijving" => "De Amerikaanse ontwerper Alexander Wang nam na drie jaar afscheid van Balenciaga",));


$artikelBestaatNiet = false;
$individueelArtikel = false;

if(isset($_GET['id'])) {
    
    $id = $_GET['id'];
    if ( array_key_exists( $id , $artikels ) )
            {
                $individueelArtikel	=	true;
            }
            else
            {
                $artikelBestaatNiet = true; 
            }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php 
        if ( !$artikelBestaatNiet && !$individueelArtikel ) { ?>
            <title>Artikels van de dag</title>
        <?php } 
        elseif ( $individueelArtikel ) { ?>
            <title>Artikel: <?php echo $artikels[$id]['titel'] ?></title>
        <?php }
        else { ?>
            <title>Artikel bestaat niet</title>
        <?php } ?>
        
    <style>
        
        .article {
            width: 25%;
            float: left;
            margin-left: 6%;
        }
        
        section:last-child() {
            margin-left: 0;
        }
        
        .article img {
            width: 80%;
            
        }
        
    .clearfix:after {
         visibility: hidden;
         display: block;
         font-size: 0;
         content: " ";
         clear: both;
         height: 0;
     }
    .clearfix { display: inline-block; }
    /* start commented backslash hack \*/
    * html .clearfix { height: 1%; }
    .clearfix { display: block; }
    /* close commented backslash hack */

    </style>
</head>
<body>
   <section class="clearfix">     

    <?php foreach ($artikels as $key => $artikel) { ?>
    
    <div class="article">

        <h1><?= $artikel["titel"] ?></h1>
        
        <p>
        
        <?php 
            if ( $_GET['id'] == $key ) { 
                echo $artikel["inhoud"]; 
            }
            else {
                echo substr($artikel["inhoud"], 0, 50); ?>
                ...
                <a href="opdracht-get-deel1.php?id=<?php echo $key ?>">Lees meer </a>
            <?php } 
        ?>    
        </p>
        
        
        <img src="<?= $artikel['afbeelding'] ?>" alt="<?= $artikel['beschrijving'] ?>">
        
    
    </div>
    
    <?php } ?>
    </section>
</body>
</html>