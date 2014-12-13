<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<svg
   xmlns="http://www.w3.org/2000/svg"
   width="210"
   height="297"
   id="svg2"
   version="1.1">
	 
    <?php
	/**
	 * Autor: Christian Kollross, DPSG Stamm Stadtschwarzach
	 * Veröffentlich: 13.12.2014
	 * Lizenz: BSD (http://opensource.org/licenses/bsd-license.php)
	 */
	
		/**
		 * Grund-Grafikparameter in Pixeln (Millimeter wären schöner gewesen, aber anscheinend kann man die nicht in Pfaden verwenden.)
		 */
		$kreisZentrumVersatz = -30;
		$standardwinkel = 7.3;
		$stufenradius = 220;
		$ebenenabstand = 24;
		$textabstand = 8;
		$fontsize = 11;
		
		// Die Liste der Stufen sollte sich in der Anzahl nicht verändern, andernfalls müssen noch weitere Parameter angepasst werden
		$stufen=array('Wölflinge','Jungpfadfinder','Pfadfinder','Rover','Leiterrunde');
		
		// Die Texte, die beschreiben was es neben der eigenen Gruppierung noch gibt
		$ebenenRest=array('9 weitere Stämme','4 weitere Bezirke','24 weitere Diözesen','BdP und VCP','Andere Länder');
		
		// Die Namen der eigenen Gruppierungen, auf die Länge achten!
		$ebenen=array('Stm. Charles de Foucauld','Bezirk Frankfurt','Diözese Limburg','DPSG','RdP','WOSM');
		
		// Ausgeschriebene Organisationsnamen in kleinerer Schriftart
		$ebenenInfo=array('','','','Deutsche Pfadfinderschaft Sankt Georg','Ring Deutscher Pfadfinderverbände','World Organization of the Scout Movement');
		
		// Der Einzug (Zusatz-Abstand von der Mitte) der Texte "n weitere Stämme/Bezirke/Diözesen" etc. in dieser Reihenfolge
		$ebenenEinzug=array(5,5,-3,30,30);
		
		// Ebenen-Pfade erstellen
		print('<defs>');
		for($i = 0; $i < 6; $i++) {
			$radius = $stufenradius-($ebenenabstand/2)-($ebenenabstand*$i);
		
			// Pfad für den Haupttext der Ebene
			print('<path id = "ebene'.$i.'" d = "M 0,'.($radius+$kreisZentrumVersatz).' A '.$radius.','.$radius.' 0 0,0 '.$radius.','.$kreisZentrumVersatz.'"/>');
			$radius += ($ebenenabstand/3);
			// Pfad für den ausgeschriebenen Organisationsnamen
			print('<path id = "ebeneninfo'.$i.'" d = "M 0,'.($radius+$kreisZentrumVersatz).' A '.$radius.','.$radius.' 0 0,0 '.$radius.','.$kreisZentrumVersatz.'"/>');
		}
		print('</defs>');
		
		// Wir wollen jetzt Grafikelemente malen
		print('<g inkscape:label="Ebene 1" inkscape:groupmode="layer" id="layer1">');
		
		// Altersstufen ausgeben
		for($i=0; $i < sizeof($stufen); $i++) {
			// Rechteck für die von der Mitte ausgehenden Linien
			print('<rect  x="0" y="-20" width="2000" height="2000" stroke-width="3" transform="rotate(' . -1*$standardwinkel*($i+1) . ' 0, -30)" stroke="black" fill="white" />');
			// Stufennamen schreiben
			print('<text x="' . ($stufenradius+$textabstand) . '" y="-26" fill="black" transform="rotate(' . (90-($standardwinkel/2)-($standardwinkel*$i)) . ', 0,-30)" style="font-family: sans-serif; font-size: ' . $fontsize . 'px">' . $stufen[$i] . '</text>');
		}
		
		// Höhere Ebenen-Rest (weitere Stämme, Bezirke etc.) ausgeben (von Außen nach Innen)
		for($i=0; $i < sizeof($stufen)+1; $i++) {
			// Kreis über die vorige Ebene malen, jedes mal etwas kleiner
			print('<circle cx="0" cy="-30" r="'. ($stufenradius-($ebenenabstand*$i)) . '" stroke-width="3" stroke="black" fill="white" />');
			// Bei der letzten Stufe brauchen wir kein Rechteck mehr
			if($i < 5) {
				// Rechteck für die von der Mitte ausgehenden Linien (deckt alles rechts oberhalb weiß ab, d. h. auch den darunterliegenden Kreis
				print('<rect  x="0" y="-20" width="2000" height="2000" stroke-width="3" transform="rotate(' . (-1*sizeof($stufen)*$standardwinkel-($standardwinkel*$i)) . ' 0, -30)" stroke="black" fill="white" />');
				
				print('<text x="' . ($stufenradius-(($i+1)*($ebenenabstand))+$textabstand+$ebenenEinzug[$i]) . '" y="-26" fill="black" transform="rotate(' . (90-1*sizeof($stufen)*$standardwinkel-($standardwinkel/2)-($standardwinkel*$i)) . ', 0,-30)" style="font-family: sans-serif; font-size: ' . $fontsize . 'px">' . $ebenenRest[$i] . '</text>');
			}
		}
		
		// Geschwungene Texte schreiben
		for($i = 0; $i < 6; $i++) {
			// Namen der Hierarchieebene auf den oben festgelegten Pfad schreiben
			print('<text style="font-family: sans-serif; font-size: ' . $fontsize . 'px" ><textPath xlink:href = "#ebene'.$i.'">'.$ebenen[$i].'</textPath><use x = "0" y = "0" xlink:href = "#ebene'.$i.'" stroke = "black" fill = "none"/></text>');
			// Ggf. ausgeschriebene Organisationsabkürzung darunter schreiben
			print('<text style="font-family: sans-serif; font-size: ' . ($fontsize-5) . 'px" ><textPath xlink:href = "#ebeneninfo'.$i.'">'.$ebenenInfo[$i].'</textPath><use x = "0" y = "0" xlink:href = "#ebeneninfo'.$i.'" stroke = "black" fill = "none"/></text>');
		}
	?>
	 
  </g>
</svg>
