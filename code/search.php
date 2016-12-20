<?php

require_once('crossref.php');
require_once(dirname(__FILE__) . '/fingerprint.php');
require_once(dirname(__FILE__) . '/lcs.php');



$citations = array(
'd41d8cd98f00b204e9800998ecf8427e' => '',
'31ae2155265a92bcb5efdf6d2ec76897' => 'Ac√≠n-P√©rez,R,Rebeca;Bayona-Bafaluy,MP,Mar√≠a Pilar;Bueno,M,Marta;Machicado,C,Claudia;Fern√°ndez-Silva,P,Patricio;P√©rez-Martos,A,Acisclo;Montoya,J,Julio;L√≥pez-P√©rez,MJ,M J;Sancho,J,Javier;Enr√≠quez,JA,Jos√© Antonio An intragenic suppressor in the cytochrome c oxidase I gene of mouse mitochondrial DNA. Human Molecular Genetics 2003-02-01;12(3):329-39',
'ed0097cbe2947b330602b3e7f4b21d9f' => 'Anais Krystel Renaud BIODIVERSITY OF THE MUSCIDAE (DIPTERA) FROM CHURCHILL, MANITOBA, CANADA, WITH TAXONOMIC ISSUES REVEALED OR RESOLVED BY DNA BARCODING Thesis 2011-12-01',
'bf55e93273f6eb4efd7fa3f6272de0b0' => 'Ashfaq, Muhammad; Ara, Jehan; Noor, Ali Raza; Hebert, Paul D N; Mansoor, Shahid Molecular phylogenetic analysis of a scale insect (Drosicha mangiferae; Hemiptera: Monophlebidae) infesting mango orchards in Pakistan European Journal of Entomology 2011-12-31;108(4):553-559',
'799e08f8c952669989263d49da8fcf64' => 'Axel Hausmann New and interesting geometrid moths from Sokotra islands Mitteilungen der Munchner Entomologischen Gesellschaft 2009-10-15;99(1):93-102',
'a7fe35b1f42f03b4c25b58ecede8fe76' => 'Ayre,DJ,D J;Minchinton,TE,T E;Perrin,C,C Does life history predict past and current connectivity for  rocky intertidal invertebrates across a marine biogeographic  barrier? Molecular Ecology 2009-05-01;18(9):1887-1903',
'51c1cdddcc38ed364cb7adf6db48e018' => 'Baldwin, Carole C.; Brito, Balam J.; Smith, David G.; Weigt, Lee A.; Escobar-Briones, Elva Identification of early life-history stages of Caribbean Apogon (Perciformes: Apogonidae) through DNA Barcoding Zootaxa 2011-12-16;3133(In Press):1-36',
'c99137eca8f74dfa933c6cc9f444f05d' => 'Baldwin,BS,B S;Black,M,M;Sanjur,O,O;Gustafson,R,R;Lutz,RA,R A;Vrijenhoek,RC,R C A diagnostic molecular marker for zebra mussels (Dreissena polymorpha) and potentially co-occurring bivalves: mitochondrial COI. Molecular Marine Biology and Biotechnology 1996-03-01;5(1):9-14',
'f89ae621bf8b218babb891c849888146' => 'Barcenas,NM,N M;Unruh,TR,T R;Neven,LG,L G DNA diagnostics to identify internal feeders (Lepidoptera: Tortricidae) of pome fruits of quarantine importance. Journal of Economic Entomology 2005-04-01;98(2):299-306',
'11bd2f54a2f7eda58749234e88c04864' => 'Basquin, Patrick; Rougerie, Rodolphe Contribution a la connaissance du genre Maltagorea Bouyer, 1993 : description d`une nouvelle espece revelee par la combinaison de caracteres morphologiques et de codes barres ADN (Lepidoptera, Saturniidae) Bulletin de la Societe Entomologique de France 2009-01-01;114(3):257-263',
'ddf487d56df9f3703ee85f85c31d100c' => 'Bely,AE,Alexandra E;Wray,GA,Gregory A Molecular phylogeny of naidid worms (Annelida: Clitellata) based on cytochrome oxidase I. Molecular Phylogenetics and Evolution 2004-01-01;30(1):50-63',
'523ec3ebd30969629341f3a9f8807b2d' => 'Bernasconi,MV,M V;Valsangiacomo,C,C;Piffaretti,JC,J C;Ward,PI,P I Phylogenetic relationships among muscoidea (Diptera: calyptratae) based on mitochondrial DNA sequences. Insect Molecular Biology 2000-02-01;9(1):67-74',
'7e3bc2a46638a5afc4ff998a55817f28' => 'Blacket, Mark J.; Malipatil, Mallik B. Redescription of the Australian metallic-green tomato fly, Lamprolonchaea brouniana (Bezzi) (Diptera: Lonchaeidae), with notes on the Australian Lamprolonchaea fauna Zootaxa 2010-11-08;2670(1):31-51',
'55c2235959d053584c1236489425b62b' => 'Borda,E,Elizabeth;Siddall,ME,Mark E Arhynchobdellida (Annelida: Oligochaeta: Hirudinida): phylogenetic relationships and evolution. Molecular Phylogenetics and Evolution 2004-01-01;30(1):213-25',
'55b1deed797634b47ecd4fa82009b177' => 'Brevignon, L; Brevignon, C Le genre Junonia en Guyane - nouvelles observations et révision systématique (Lepidoptera : Nymphalidae) Lépidoptères de Guyane 2012-10-01;7(-):8-35',
'070edd8fcd1cd37ef12663f62658b58e' => 'Brix, Saskia; Riehl, Torben; Leese, Florian First genetic data for species of the genus Haploniscus Richardson, 1908 (Isopoda: Asellota: Haploniscidae) from neighbouring deep-sea basins in the South Atlantic Zootaxa 2011-04-29;2838(1):79-84',
'161b0830766605ac5ec623ebaada186e' => 'Brown, John W; Miller, Scott E; Horak, Marianne Studies on New Guinea moths. 2. Description of a new species of Xenothictis Meyrick (Lepidoptera: Tortricidae: Archipini) Proceedings of the Entomological Society of Washington 2003-10-01;105(4):1043-50',
'5dd25c139e66e77c882a16bdbcb43aae' => 'Brown,MD,M D;Zhadanov,S,S;Allen,JC,J C;Hosseini,S,S;Newman,NJ,N J;Atamonov,VV,V V;Mikhailovskaya,IE,I E;Sukernik,RI,R I;Wallace,DC,D C Novel mtDNA mutations and oxidative phosphorylation dysfunction in Russian LHON families. Human Genetics 2001-07-01;109(1):33-9',
'f2982e31dcf5d4154e620516340de606' => 'Caterino,MS,M S;Reed,RD,R D;Kuo,MM,M M;Sperling,FA,F A A partitioned likelihood analysis of swallowtail butterfly phylogeny (Lepidoptera:Papilionidae). Systematic Biology 2001-02-01;50(1):106-27',
'ec7a447b5ed65ac02925bf9b502a2a84' => 'Chac√≥n, I; Montero, J.J.M.R.; Janzen, D; Hallwachs, W; Blandin, P; Bristow, C R; Hajibabaei, M; History, Florida Museum of Natural A NEW SPECIES OF OPSIPHANES DOUBLEDAY, [1849] FROM COSTA RICA (NYMPHALIDAE: MORPHINAE: BRASSOLINI), AS REVEALED BY ITS DNA BARCODES AND HABITUS Bulletin of the Allyn Museum 2012-11-05;166:1-15',
'a86223b38febe436d3d46d43abf88b0f' => 'Chen,WY,Wei-Yun;Hung,TH,Ting-Hsuan;Shiao,SF,Shiuh-Feng Molecular identification of forensically important blow fly species (Diptera: Calliphoridae) in Taiwan. Journal of Medical Entomology 2004-01-01;41(1):47-57',
'861ff647ac818005cabc04bff8811e45' => 'Choi,YS,Yong Soo;Bae,JS,Jin Sik;Lee,KS,Kwang Sik;Kim,SR,Seong Ryul;Kim,I,Iksoo;Kim,JG,Jong Gill;Kim,KY,Keun Young;Kim,SE,Sam Eun;Suzuki,H,Hirobumi;Lee,SM,Sang Mong;Sohn,HD,Hung Dae;Jin,BR,Byung Rae Genomic structure of the luciferase gene and phylogenetic analysis in the Hotaria-group fireflies. Comparative Biochemistry and Physiology - Part B: Biochemistry and Molecular Biology 2003-02-01;134(2):199-214',
'bf304f7589cd6f912e5e5a22505ccb5e' => 'Clark,TL,T L;Meinke,LJ,L J;Foster,JE,J E Molecular phylogeny of Diabrotica beetles (Coleoptera: Chrysomelidae) inferred from analysis of combined mitochondrial and nuclear DNA sequences. Insect Molecular Biology 2001-08-01;10(4):303-14',
'7f123ca6feeaf409a964353b186e4de3' => 'Clarkston, Bridgette E.; Saunders, Gary W. A comparison of two DNA barcode markers for species discrimination in the red algal family Kallymeniaceae (Gigartinales) with a description of Euthora timburtoni Botany 2010-02-25;88(1):119-131',
'705b43689a6e7ed11e26b23d647606cf' => 'Collin,R,Rachel;Chaparro,OR,Oscar R;Winkler,F,Federico;Véliz,D,David Molecular phylogenetic and embryological evidence that feeding larvae have been reacquired in a marine gastropod. The Biological Bulletin 2007-04-01;212(2):83-92',
'957a59817d89ae7170501f159c60b651' => 'D. A. Downie Locating the sources of an invasive pest, grape phylloxera, using a mitochondrial DNA gene genealogy. Molecular Ecology 2002-10-01;11(10):2013-26',
'e06412e5de4eae50785080e45706943a' => 'Dallas,JF,J F;Cruickshank,RH,R H;Linton,YM,Y-M;Nolan,DV,D V;Patakakis,M,M;Braverman,Y,Y;Capela,R,R;Capela,M,M;Pena,I,I;Meiswinkel,R,R;Ortega,MD,M D;Baylis,M,M;Mellor,PS,P S;Mordue Luntz,AJ,A J Phylogenetic status and matrilineal structure of the biting midge, Culicoides imicola, in Portugal, Rhodes and Israel. Medical and Veterinary Entomology 2003-12-01;17(4):379-87',
'e04a0e322045728ecb7e46b0084fdde2' => 'Daniels,SR,Savel R;Stewart,BA,Barbara A;Gouws,G,Gavin;Cunningham,M,Michael;Matthee,CA,Conrad A Phylogenetic relationships of the southern African freshwater crab fauna (Decapoda: Potamonautidae: Potamonautes) derived from multiple data sets reveal biogeographic patterning. Molecular Phylogenetics and Evolution 2002-12-01;25(3):511-23',
'd6fa44b1a4d1f8e7fe81347b7685d52b' => 'David Adamski Order Lepidoptera, Family Coleophoridae, Subfamily Blastobasinae Arthropod Fauna of the United Arab Emirates 2010-03-31;3(3):525-531',
'ada24ddefdd10c2638b5388e1149892c' => 'Degnan,PH,Patrick H;Lazarus,AB,Adam B;Brock,CD,Chad D;Wernegreen,JJ,Jennifer J Host-symbiont stability and fast evolutionary rates in an ant-bacterium association: cospeciation of camponotus species and their endosymbionts, candidatus blochmannia. Systematic Biology 2004-02-01;53(1):95-110',
'8ac7aef1ecdb0c519f2fc7ee8534ecaa' => 'Di Luca,M,Marco;Boccolini,D,Daniela;Marinuccil,M,Marino;Romi,R,Roberto Intrapopulation polymorphism in Anopheles messeae (An. maculipennis complex) inferred by molecular analysis. Journal of Medical Entomology 2004-07-01;41(4):582-6',
'e80ce295cfab12f108e74a3568cc0c99' => 'Donald,KM,Kirsten M;Kennedy,M,Martyn;Spencer,HG,Hamish G Cladogenesis as the result of long-distance rafting events in South Pacific topshells (Gastropoda, Trochidae). Evolution 2005-08-01;59(8):1701-11',
'818fe8558da90d115093645b321cf31c' => 'Downie,DA,D A;Fisher,JR,J R;Granett,J,J Grapes, galls, and geography: the distribution of nuclear and mitochondrial DNA variation across host-plant species and regions in a specialist herbivore. Evolution 2001-07-01;55(7):1345-62',
'faf9bd1bd4c7fe843cbb24d0f44229c3' => 'Eastwood,R,Rod;Hughes,JM,Jane M Molecular phylogeny and evolutionary biology of Acrodipsas (Lepidoptera: Lycaenidae). Molecular Phylogenetics and Evolution 2003-04-01;27(1):93-102',
'eee4573fcbc4954abc9bd433008e9123' => 'Efetov, Konstantin A; Tarmann, Gerhard M A new European species, Adscita dujardini sp. nov. (Lepidoptera: Zygaenidae, Procridinae), confirmed by DNA analysis Entomologist\'s Gazette 2014-07-29;65(-):179-200',
'776fff34dbfba3b40a7fb64ea04daae0' => 'Elizabeth Grace Boulding Molecular evidence against phylogenetically distinct host races of the pea aphid (Acyrthosiphon pisum). Genome 1998-12-01;41(6):769-75',
'93109570b1ba98cced1eebeaa19af24a' => 'Emlen,DJ,Douglas J;Marangelo,J,Jennifer;Ball,B,Bernard;Cunningham,CW,Clifford W Diversity in the weapons of sexual selection: horn evolution in the beetle genus Onthophagus (Coleoptera: Scarabaeidae). Evolution 2005-05-01;59(5):1060-84',
'4b8fc69c1bfe1d0977f29465bf875d3d' => 'Evans, Ben J; Carter, Timothy F; Tobias, Martha L; Kelley, Darcy B; Hanner, Robert; Tinsley, Richard C A new species of clawed frog (genus Xenopus) from the Itombwe Massif, Democratic Republic of the Congo: implications for DNA barcodes and biodiversity conservation. Zootaxa 2008-05-28;1780(n/a):55-68',
'f7f62b8f60ac1f944b8b7831261db948' => 'Farrell,BD,B D;Sequeira,AS,A S;O\'Meara,BC,B C;Normark,BB,B B;Chung,JH,J H;Jordal,BH,B H The evolution of agriculture in beetles (Curculionidae: Scolytinae and Platypodinae). Evolution 2001-10-01;55(10):2011-27',
'bd665b577f7751f125444d9cd3ba2fd8' => 'Florin,DA,David A;Davies,SJ,Stephen J;Olsen,C,Cara;Lawyer,P,Phillip;Lipnick,R,Robert;Schultz,G,George;Rowton,E,Edgar;Wilkerson,R,Richard;Keep,L,Lisa Morphometric and molecular analyses of the sand fly species Lutzomyia shannoni (Diptera: Psychodidae: Phlebotominae) collected from seven different geographical areas in the southeastern United States. Journal of Medical Entomology 2011-03-01;48(2):154-66',
'9170e55d2411a07380398e7562ea891d' => 'France,SC,S C;Kocher,TD,T D DNA sequencing of formalin-fixed crustaceans from archival research collections. Molecular Marine Biology and Biotechnology 1996-12-01;5(4):304-13',
'ea5d71ebb47d6ad084d5586d35a0eb08' => 'FRANTISEK SLAMKA, COLIN W. PLANT MECYNA BALCANICA SP. NOV., A CLOSELY RELATED SPECIES TO MECYNA FLAVALIS ([DENIS & SCHIFFERMÜLLER], 1775) AND M. LUTEALIS (DUPONCHEL, 1833) (PYRALOIDEA, CRAMBIDAE, SPILOMELINAE) The Entomologist\'s Record and Journal of Variation 2016-06-01;128:137-145',
'799ccb474e8a92598b7600be6254587f' => 'Frédéric Bénéluz Description du mâle d\'Automeris despicata Draudt, 1929 (Lepidoptera: Saturniidae, Hemileucinae) The European Entomologist 2013-11-20;4(4):195-207',
'90b8d97e0003ecbc91c7374eb3ce77df' => 'Gadaleta,G,G;Pepe,G,G;De Candia,G,G;Quagliariello,C,C;Sbisà,E,E;Saccone,C,C The complete nucleotide sequence of the Rattus norvegicus mitochondrial genome: cryptic signals revealed by comparative analysis between vertebrates. Journal of Molecular Evolution 1989-06-01;28(6):497-516',
'dc336955a626efd0ffabf159059372f4' => 'Gall, Line LE; Saunders, Gary W Establishment of a DNA-barcode library for the Nemaliales (Rhodophyta) from Canada and France uncovers overlooked diversity in the species Nemalion helminthoides (Velley) Batters Cryptogamie: Algologie 2010-11-01;31(4):403-421',
'c42d714ac7f761c69fe1db68ff513230' => 'García,BA,B A;Powell,JR,J R Phylogeny of species of Triatoma (Hemiptera: Reduviidae) based on mitochondrial DNA sequences. Journal of Medical Entomology 1998-05-01;35(3):232-8',
'd16e49e0b958984ef74b865727d208de' => 'Garros,C,Claire;Harbach,RE,Ralph E;Manguin,S,Sylvie Systematics and biogeographical implications of the phylogenetic relationships between members of the funestus and minimus groups of Anopheles (Diptera: Culicidae). Journal of Medical Entomology 2005-01-01;42(1):7-18',
'00f94f18f1a7c4205729660e47ba61ba' => 'Georges E R J Orhant Aporophyla lutulenta (Denis et Schiffermüller, 1775) et Aporophyla lueneburgensis (Freyer, 1848), une seule et même espèce ! (Lep. Noctuidae). Oreina 2012-06-01;18(juin 2012):4-9',
'8dfa8243907b9d4206e39207a0bee186' => 'Gittenberger,E,E;Piel,WH,W H;Groenenberg,DS,D S J The Pleistocene glaciations and the evolutionary history of the polytypic snail species Arianta arbustorum (Gastropoda, Pulmonata, Helicidae). Molecular Phylogenetics and Evolution 2004-01-01;30(1):64-73',
'0104403e2a68b2ce10f0fe4e42ec1b96' => 'Greg S. Spicer Phylogenetic utility of the mitochondrial cytochrome oxidase gene: molecular evolution of the Drosophila buzzatii species complex. Journal of Molecular Evolution 1995-12-01;41(6):749-59',
'ca5441626ac1f8aabb04f9f4bff9a7b5' => 'G√≥mez,A,Africa;Serra,M,Manuel;Carvalho,GR,Gary R;Lunt,DH,David H Speciation in ancient cryptic species complexes: evidence from the molecular phylogeny of Brachionus plicatilis (Rotifera). Evolution 2002-07-01;56(7):1431-44',
'dc69f9a63c637589eea12d76fbeeeec5' => 'Harley,CD,C D G;Pankey,MS,M S;Wares,JP,J P;Grosberg,RK,R K;Wonham,MJ,M J Color polymorphism and genetic structure in the sea star Pisaster ochraceus. The Biological Bulletin 2006-12-01;211(3):248-62',
'4870701f0ddb1a115fa8b5e3c8ca27a2' => 'Harvey,ML,M L;Mansell,MW,M W;Villet,MH,M H;Dadour,IR,I R Molecular identification of some forensically important blowflies of southern Africa and Australia. Medical and Veterinary Entomology 2003-12-01;17(4):363-9',
'008ca4ea36a53285d9844ac52827a653' => 'Hassanin,A,Alexandre;Léger,N,Nelly;Deutsch,J,Jean Evidence for multiple reversals of asymmetric mutational constraints during the evolution of the mitochondrial genome of metazoa, and consequences for phylogenetic inferences. Systematic Biology 2005-04-01;54(2):277-98',
'b32461ad81b6833bf41a91d7c6fe9859' => 'Hoeh,WR,W R;Stewart,DT,D T;Saavedra,C,C;Sutherland,BW,B W;Zouros,E,E Phylogenetic evidence for role-reversals of gender-associated mitochondrial DNA in Mytilus (Bivalvia: Mytilidae). Molecular Biology and Evolution 1997-09-01;14(9):959-67',
'1f546e8cca70fd1981a10ef77b13bd3e' => 'Hormiga,G,Gustavo;Arnedo,M,Miquel;Gillespie,RG,Rosemary G Speciation on a conveyor belt: sequential colonization of the hawaiian islands by Orsonwelles spiders (Araneae, Linyphiidae). Systematic Biology 2003-02-01;52(1):70-88',
'721011ffbf725eb5650b936b002efecc' => 'Ironside,JE,J E;Dunn,AM,A M;Rollinson,D,D;Smith,JE,J E Association with host mitochondrial haplotypes suggests that feminizing microsporidia lack horizontal transmission. Journal of Evolutionary Biology 2003-11-01;16(6):1077-83',
'9955f17be0bf0802eb1b1e0ed03b962d' => 'Jamie R. Stevens The evolution of myiasis in blowflies (Calliphoridae). International Journal for Parasitology 2003-09-15;33(10):1105-13',
'6a6194e63a2ff7cc05b096ec1db2d64e' => 'Jeffery,CH,Charlotte H;Emlet,RB,Richard B;Littlewood,DT,D T J Phylogeny and evolution of developmental mode in temnopleurid echinoids. Molecular Phylogenetics and Evolution 2003-07-01;28(1):99-118',
'bf30b413f94ee43fc792b8377612b0ae' => 'Joomun, N; Ganeshan, S; Dookun-Saumtally, A Identification of three armyworm species (Lepidoptera: Noctuidae) using DNA barcodes and restriction enzyme digestion International Sugar Journal 2012-04-01;114(1361):344-349',
'a2c274615514e2812bb1fae79006193b' => 'Kai Heller, Arne Köhler, Frank Menzel, Kjell Magne Olsen and Øivind Gammelmo Two formerly unrecognized species of Sciaridae (Diptera) revealed by DNA barcoding Norwegian Journal of Entomology 2016-06-21;63(1):96–115',
'c0689e8d41ca8036a7368068e0cb86bd' => 'Kawakita,A,Atsushi;Takimura,A,Atsushi;Terachi,T,Toru;Sota,T,Teiji;Kato,M,Makoto Cospeciation analysis of an obligate pollination mutualism: have Glochidion trees (Euphorbiaceae) and pollinating Epicephala moths (Gracillariidae) diversified in parallel? Evolution 2004-10-01;58(10):2201-14',
'3720877976db4678776730ad658fb669' => 'Kijas,JM,J M;Andersson,L,L A phylogenetic study of the origin of the domestic pig estimated from the near-complete mtDNA genome. Journal of Molecular Evolution 2001-03-01;52(3):302-8',
'aea18134e8ae2bd358cfbfd876d0e225' => 'Kim,H,Hyojoong;Lee,S,Seunghwan Molecular systematics of the genus Megoura (Hemiptera: Aphididae) using mitochondrial and nuclear DNA sequences. Molecules and Cells 2008-06-30;25(4):510-22',
'b06a56eb489bb9e52e0221d73970c9a1' => 'Kittler,R,Ralf;Kayser,M,Manfred;Stoneking,M,Mark Molecular evolution of Pediculus humanus and the origin of clothing. Current Biology 2003-08-19;13(16):1414-7',
'e906c7c54f18e2647151ba14ddf10003' => 'Kobayashi,N,N;Tamura,K,K;Aotsuka,T,T PCR error and molecular population genetics. Biochemical Genetics 1999-10-01;37(-1):317-21',
'03511af0c7933e6c6dca8a67ecfa176d' => 'Kobayashi,N,N;Tamura,K,K;Aotsuka,T,T;Katakura,H,H Molecular phylogeny of twelve Asian species of epilachnine ladybird beetles (Coleoptera, Coccinellidae) with notes on the direction of host shifts. Zoological Science 1998-02-01;15(1):147-51',
'e35fac2fb79f7f41b04cf7cb375352cc' => 'Kumar,NP,N Pradeep;Rajavel,AR,A R;Natarajan,R,R;Jambulingam,P,P DNA barcodes can distinguish species of Indian mosquitoes (Diptera: Culicidae). Journal of Medical Entomology 2007-01-01;44(1):1-7',
'8afb23da65174b92837691da6b48e164' => 'Kvamme, Torstein; Wallin, Henrik; Kvie, Kjersti S Taxonomy and DNA barcoding of Stenostola ferrea (Schrank, 1776) and S. dubia (Laicharting, 1784) (Coleoptera, Cerambycidae, Saperdini) Norwegian Journal of Entomology 2012-06-11;2012(59):78-87',
'26463793ad5ed281bec61ff2e166d1d4' => 'Kvifte, Gunnar M; Andersen, Trond Moth flies (Diptera, Psychodidae) from Finnmark, northern Norway Norwegian Journal of Entomology 2012-12-05;59(2):108-119',
'2dd0aba8581ff057faa3f0d492f17fe8' => 'L. Lacey Knowles Tests of pleistocene speciation in montane grasshoppers (genus Melanoplus) from the sky islands of western North America. Evolution 2000-08-01;54(4):1337-48',
'2b2e2fa12935c5dd408cf0bac8581634' => 'Langmaid, John R.; Sattler, Klaus; Lopez-Vaamonde, Carlos Morphology and DNA barcodes show that Calybites hauderi does not occur in the British Isles (Gracillariidae) Nota Lepidopterologica 2011-01-24;33(2):191-197',
'615edf394e5793844c6b97f818df5e11' => 'Langor,DW,D W;Sperling,FA,F A Mitochondrial DNA sequence divergence in weevils of the Pissodes strobi species complex (Coleoptera:Curculionidae). Insect Molecular Biology 1997-08-01;6(3):255-65',
'a079c05959ab6d0ffe34e150145b611b' => 'Lastuvka, Z; Lastuvka, A; Lopez-Vaamonde, C A revision of the Phyllonorycter ulicicolella species group with description of a new species (Lepidoptera: Gracillariidae) SHILAP: Revista de Lepidopterologia 2013-06-01;41(162):251-265',
'f0a8bb11e4bec35526abd2ce2e0bda52' => 'Lenaïg G. HEMERY, Michel ROUX, Nadia AMEZIANE and Marc ELEAUME High-resolution crinoid phyletic inter-relationships derived from molecular data Cahiers de Biologie Marine 2013-10-31;54(4):511-523',
'e4659be8da62c58de621b8e26bd08133' => 'Lewis,DL,D L;Farr,CL,C L;Kaguni,LS,L S Drosophila melanogaster mitochondrial DNA: completion of the nucleotide sequence and evolutionary comparisons. Insect Molecular Biology 1995-11-01;4(4):263-78',
'b812312f9cd78f2bb13844794cab6b41' => 'Libert, Michel Sur la taxonomie du genre Celaenorrhinus Hübner en Afrique (Lepidoptera, Hesperiidae) Edited book (Libert Ed.) 2014-12-31',
'0d485f62b410628a4c0d18fd081df5f3' => 'Light,JE,J E;Siddall,ME,M E Phylogeny of the leech family Glossiphoniidae based on mitochondrial gene sequences and morphological data. Journal of Parasitology 1999-10-01;85(5):815-23',
'b79fd4a783a7715b7362ddd53965c572' => 'Lin,CP,Chung-Ping;Danforth,BN,Bryan N;Wood,TK,Thomas K Molecular phylogenetics and evolution of maternal care in Membracine treehoppers. Systematic Biology 2004-06-01;53(3):400-21',
'fb3cd69a8d71ae0480bd89c4c5aef5f6' => 'Linto,YM,Y M;Mordue Luntz,AJ,A J;Cruickshank,RH,R H;Meiswinkel,R,R;Mellor,PS,P S;Dallas,JF,J F Phylogenetic analysis of the mitochondrial cytochrome oxidase subunit I gene of five species of the Culicoides imicola species complex. Medical and Veterinary Entomology 2002-06-01;16(2):139-46',
'd9b80c22a035fce948c28420a3bdc065' => 'Lissovsky, Andrey A.; Ivanova, Natalia V.; Borisenko, Alex V. Molecular phylogenetics and taxonomy of the subgenus Pika (Ochotona, Lagomorpha). Journal of Mammalogy 2007-01-01;88(5):1195-1204',
'21339c8b903edca9c73761bfb1e6bcb2' => 'Mahendran,B,B;Ghosh,SK,S K;Kundu,SC,S C Molecular phylogeny of silk-producing insects based on 16S ribosomal RNA and cytochrome oxidase subunit I genes. Journal of Genetics 2006-04-01;85(1):31-8',
'6d4e6dd8739b033cb7514a27eb7593d6' => 'Marquez,JG,J G;Cummings,MA,M A;Krafsur,ES,E S Phylogeography of stable fly (Diptera: Muscidae) estimated by diversity at ribosomal 16S and cytochrome oxidase I mitochondrial genes. Journal of Medical Entomology 2007-11-01;44(6):998-1008',
'fa9123ebe823dbec56c2942cf281c69d' => 'Martin,J,J;Guryev,V,V;Blinov,A,A Population variability in Chironomus (Camptochironomus) species (Diptera, Nematocera) with a Holarctic distribution: evidence of mitochondrial gene flow. Insect Molecular Biology 2002-10-01;11(5):387-97',
'4131ee2e62d0055186fed5b4299f9bfe' => 'Michel Libert Revision du genre Aphnaeus (Lepidoptera, Lycaenidae) Revision du genre Aphnaeus (Lepidoptera, Lycaenidae), M. Libert ed. 2013-11-14;1(1):100',
'0f1dd3107c32b71817457baad9fa56bf' => 'Miller, Scott E. DNA barcoding in floral and faunal research Systematics Association Special Volume 2014-12-19;84:296-311',
'21f7c2c0b82bfcb2e1319d1c18fcc394' => 'Mindell,DP,D P;Sorenson,MD,M D;Dimcheff,DE,D E;Hasegawa,M,M;Ast,JC,J C;Yuri,T,T Interordinal relationships of birds and other reptiles based on whole mitochondrial genomes. Systematic Biology 1999-03-01;48(1):138-52',
'044c0016632289e56ddbfdc2d79035a8' => 'Miya,M,M;Kawaguchi,A,A;Nishida,M,M Mitogenomic exploration of higher teleostean phylogenies: a case study for moderate-scale evolutionary genomics with 38 newly determined complete mitochondrial DNA sequences. Molecular Biology and Evolution 2001-11-01;18(11):1993-2009',
'aa7ab3d92fdc678dc1b859f5ede8c1a7' => 'Morlais,I,I;Severson,DW,D W Complete mitochondrial DNA sequence and amino acid analysis of the cytochrome C oxidase subunit I (COI) from Aedes aegypti. DNA Sequence 2002-04-01;13(2):123-7',
'071297c23aee8449f8c12ada03764882' => 'Morse,GE,Geoffrey E;Farrell,BD,Brian D Ecological and evolutionary diversification of the seed beetle genus Stator (Coleoptera: Chrysomelidae: Bruchinae). Evolution 2005-06-01;59(6):1315-33',
'8a1e2e787b23942944f140574652ed17' => 'Mtambo,J,Jupiter;Madder,M,Maxime;Van Bortel,W,Wim;Geysen,D,Dirk;Berkvens,D,Dirk;Backeljau,T,Thierry Genetic variation in Rhipicephalus appendiculatus (Acari: Ixodidae) from Zambia: correlating genetic and ecological variation with Rhipicephalus appendiculatus from eastern and southern Africa. Journal of Vector Ecology 2007-12-01;32(2):168-75',
'3cd3a1ce680e260c84949fcb0db0f08b' => 'Naessig, Wolfgang A; Naumann, Stefan; Rougerie, Rodolphe; Nassig, Wolfgang A Evidence for the existence of three species in the genus Archaeoattacus (Lepidoptera: Saturniidae). The Journal of Research on the Lepidoptera 2010-12-21;43(N/A):37-47',
'a8b73c7492d4990e168ce3c51a3b0574' => 'Nagaraja;Nagaraju,J.;Ranganath,H. A. Molecular phylogeny of the nasuta subgroup of Drosophila based on 12S rRNA, 16S rRNA and CoI mitochondrial genes, RAPD and ISSR polymorphisms. Genes and Genetic Systems 2004-10-01;79(5):293-9',
'c05784248f2866f690189183077380c1' => 'Naumann, S Rougerie, R Nässig, W. A. Additional note on the genus Archaeoattacus Watson [in Packard], 1914: description of a fourth species (Lepidoptera: Saturniidae, Saturniinae, Attacini) Nachrichten des Entomologischen Vereins Apollo 2016-05-13;37(1):5-11',
'95043b178d61165776ff69ff19fb083d' => 'Naumann, Stefan; Loffler, S Two new species of the genus Cricula Walker, 1855 from Myanmar and India, with synonymic notes (Lepidoptera: Saturniidae) Nachrichten des Entomologischen Vereins Apollo 2013-03-01;33(4):177-184',
'a506f932a9cc882f2b923892e41a48d8' => 'Naumann, Stefan; Naessig, Wolfgang A Two species in Saturnia (Rinaca) zuleika Hope, 1843 (Lepidoptera: Saturniidae) Nachrichten des Entomologischen Vereins Apollo 2010-10-01;31(3):127-143',
'53ad5fbf50f635a84986f1b0020b4248' => 'Nicolescu,G,G;Linton,YM,Y-M;Vladimirescu,A,A;Howard,TM,T M;Harbach,RE,R E Mosquitoes of the Anopheles maculipennis group (Diptera: Culicidae) in Romania, with the discovery and formal recognition of a new species based on molecular and morphological evidence. Bulletin of Entomological Research 2004-12-01;94(6):525-35',
'e2e1cbca856af65e77643fc36e6229d7' => 'Nylander,JA,Johan A A;Ronquist,F,Fredrik;Huelsenbeck,JP,John P;Nieves-Aldrey,JL,José Luis Bayesian phylogenetic analysis of combined data. Systematic Biology 2004-02-01;53(1):47-67',
'19293e28a1c7c267e1e040f5b11633c9' => 'O\'Grady,PM,P M;Clark,JB,J B;Kidwell,MG,M G Phylogeny of the Drosophila saltans species group based on combined analysis of nuclear and mitochondrial DNA sequences. Molecular Biology and Evolution 1998-06-01;15(6):656-64',
'a04c6b97f74c7addfc5f2ab54f5d587a' => 'Orhant, Georges E. R. J. Rougerie, Rodolphe Un siècle après la description du père de Joannis, découverte de la femelle d\'Hypopyra contractipennis (Lepidoptera Erebidae Catocalinae) L\'Entomologiste 2014-11-01;70(6):331-333',
'ecf8861a7b12c6bb713128328e54dd21' => 'Osborn,KJ,Karen J;Rouse,GW,Greg W;Goffredi,SK,Shana K;Robison,BH,Bruce H Description and relationships of Chaetopterus pugaporcinus, an unusual pelagic polychaete (Annelida, Chaetopteridae). The Biological Bulletin 2007-02-01;212(1):40-54',
'2cb1758251bad804c3ea74e624fe929f' => 'P. B. Marko \'What\'s larvae got to do with it?\' Disparate patterns of post-glacial population structure in two benthic marine gastropods with identical dispersal potential. Molecular Ecology 2004-03-01;13(3):597-611',
'ce0b93509ea186485ec8cc4752d9dc32' => 'Pagès,N,N;Sarto I Monteys,V,V Differentiation of Culicoides obsoletus and Culicoides scoticus (Diptera: Ceratopogonidae) based on mitochondrial cytochrome oxidase subunit I. Journal of Medical Entomology 2005-11-01;42(6):1026-34',
'f5b55fbb30d4e21db2971870a51311a1' => 'Patsoula,E,Eleni;Samanidou-Voyadjoglou,A,Anna;Spanakos,G,Gregory;Kremastinou,J,Jenny;Nasioulas,G,Georgios;Vakalis,NC,Nikolaos C Molecular and morphological characterization of Aedes albopictus in northwestern Greece and differentiation from Aedes cretinus and Aedes aegypti. Journal of Medical Entomology 2006-01-01;43(1):40-54',
'eab27e8bf06884d40a01ae661eb55388' => 'Paukstadt, Ulrich; Paukstadt, Laela H; Rougerie, Rodolphe Contribution to knowledge of Actias groenendaeli ROEPKE, 1954 from the Lesser Sunda Islands, Indonesia with descriptions of two new subspecies (Lepidoptera: Saturniidae) Beitraege zur Kenntnis der wilden Seidenspinner 2010-03-31;8(3):125-153',
'b84c8d8566508f20b8e68ab55d868941' => 'Peek,AS,A S;Gaut,BS,B S;Feldman,RA,R A;Barry,JP,J P;Kochevar,RE,R E;Lutz,RA,R A;Vrijenhoek,RC,R C Neutral and nonneutral mitochondrial genetic variation in deep-sea clams from the family vesicomyidae. Journal of Molecular Evolution 2000-02-01;50(2):141-53',
'3ee17d224be37e73f656d475c2012956' => 'Pereira,SL,Sérgio L;Baker,AJ,Allan J;Wajntal,A,Anita Combined nuclear and mitochondrial DNA sequences resolve generic relationships within the Cracidae (Galliformes, Aves). Systematic Biology 2002-12-01;51(6):946-58',
'4873d8919a67f275e5da4efab9805257' => 'Perlman,SJ,Steve J;Spicer,GS,Greg S;Shoemaker,DD,D Dewayne;Jaenike,J,John Associations between mycophagous Drosophila and their Howardula nematode parasites: a worldwide phylogenetic shuffle. Molecular Ecology 2003-01-01;12(1):237-49',
'5be3d60891a53294193aa00d03051fc6' => 'Pfenninger,M,Markus;Staubach,S,Sid;Albrecht,C,Christian;Streit,B,Bruno;Schwenk,K,Klaus Ecological and morphological differentiation among cryptic evolutionary lineages in freshwater limpets of the nominal form-group Ancylus fluviatilis (O.F. Müller, 1774). Molecular Ecology 2003-10-01;12(10):2731-45',
'56a716a94338c0e79df9c61df1ef0e25' => 'Przemyslaw Szafranski The mitochondrial trn-cox1 locus: rapid evolution in Pompilidae and evidence of bias in cox1 initiation and termination codon usage. Mitochondrial DNA 2009-02-01;20(1):15-25',
'29f3e2e63d0e879bc33b3ad0fed1218c' => 'Quilang, Jonas P.; Santos, Brian S.; Ong, Perry S.; Basiao, Zubaida U.; Fontanilla, Ian Kendrich C; Cao, Ernelea P. DNA Barcoding of the Philippine Endemic Freshwater Sardine Sardinella tawilis (Clupeiformes: Clupeidae) and Its Marine Relatives The Philippine Agricultural Scientist 2011-09-01;94(3):248-257',
'dcfb95aa8c0e79f254d7be32bf53361a' => 'Rachel Collin The effects of mode of development on phylogeography and population structure of North Atlantic Crepidula (Gastropoda: Calyptraeidae). Molecular Ecology 2001-09-01;10(9):2249-62',
'598ca8b1c868625ca2e2ccfa0ed22784' => 'Ralph Imondi and Linda Santschi Channel Islands Kelp Forest and MPA fishes and invertebrates - data release Data Release 2012-02-29;1(1)',
'bc1afe9a1a0d242aea574876bbae4a00' => 'Rasmussen,AS,A S;Janke,A,A;Arnason,U,U The mitochondrial DNA molecule of the hagfish (Myxine glutinosa) and vertebrate phylogeny. Journal of Molecular Evolution 1998-04-01;46(4):382-8',
'f146df9febdbd076b84be585021e3f08' => 'Rees,DJ,David J;Dioli,M,Maurizio;Kirkendall,LR,Lawrence R Molecules and morphology: evidence for cryptic hybridization in African Hyalomma (Acari: Ixodidae). Molecular Phylogenetics and Evolution 2003-04-01;27(1):131-42',
'3b30354c48b25b616947b2ddcd189a6b' => 'Reimer,JD,James Davis;Ono,S,Shusuke;Fujiwara,Y,Yoshihiro;Takishita,K,Kiyotaka;Tsukahara,J,Junzo Reconsidering Zoanthus spp. diversity: molecular evidence of conspecifity within four previously presumed species. Zoological Science 2004-05-01;21(5):517-25',
'd29917bb68d580ac234223a857903357' => 'Reimer,JD,James Davis;Ono,S,Shusuke;Iwama,A,Atsushi;Takishita,K,Kiyotaka;Tsukahara,J,Junzo;Maruyama,T,Tadashi Morphological and molecular revision of Zoanthus (Anthozoa: Hexacorallia) from southwestern Japan, with descriptions of two new species. Zoological Science 2006-03-01;23(3):261-75',
'10a33eacb9e25c61e4ea0f274ed445f0' => 'Reimer,JD,James Davis;Ono,S,Shusuke;Takishita,K,Kiyotaka;Tsukahara,J,Junzo;Maruyama,T,Tadashi Molecular evidence suggesting species in the zoanthid genera Palythoa and Protopalythoa (Anthozoa: Hexacorallia) are congeneric. Zoological Science 2006-01-01;23(1):87-94',
'5723ac814fa53a4b1d6d1b5bbb70c754' => 'Renard,E,E;Bachmann,V,V;Cariou,ML,M L;Moreteau,JC,J C Morphological and molecular differentiation of invasive freshwater species of the genus Corbicula (Bivalvia, corbiculidea) suggest the presence of three taxa in French rivers. Molecular Ecology 2000-12-01;9(12):2009-16',
'84ceea40f3a665c4b3e8d344e919889a' => 'Rocha-Olivares,A,A;Fleeger,JW,J W;Foltz,DW,D W Decoupling of molecular and morphological evolution in deep lineages of a meiobenthic harpacticoid copepod. Molecular Biology and Evolution 2001-06-01;18(6):1088-102',
'77cc105549b8a82f5283308c180b308d' => 'Salomone,N,N;Frati,F,F;Bernini,F,F Investigation on the taxonomic status of Steganacarus magnus and Steganacarus anomalus (Acari:Oribatida) using mitochondrial DNA sequences. Experimental and Applied Acarology 1996-11-01;20(11):607-15',
'd1e790982cb26471535d41034dc65aca' => 'Scheffer,SJ,Sonja J;Grissell,EE,E E Tracing the geographical origin of Megastigmus transvaalensis (Hymenoptera: Torymidae): an African wasp feeding on a South American plant in North America. Molecular Ecology 2003-02-01;12(2):415-21',
'f97d596a4c3523147bf6adeffd8e21b2' => 'Segraves,KA,Kari A;Pellmyr,O,Olle Testing the out-of-Florida hypothesis on the origin of cheating in the yucca-yucca moth mutualism. Evolution 2004-10-01;58(10):2266-79',
'8c04c91d5f569494e88dce79f3b6c0b0' => 'Sheffield, Cory S; Rehan, Sandra M Morphological and molecular delineation of a new species in the Ceratina dupla species-group (Hymenoptera: Apidae: Xylocopinae) of eastern North America1 Zootaxa 2011-05-10;2873(In Press):35-50',
'318b3b1a16026c97cf8154e67260639b' => 'Shirak, Andrey; Cohen-Zinder, Miri; Barroso, Renata M.; Seroussi, Eyal; Ron, Micha; Hulata, Gideon DNA Barcoding of Israeli Indigenous and Introduced Cichlids The Israeli Journal of Aquaculture- Bamidgeh 2009-01-01;61(2):83-88',
'9382db14761cbf6bcb5a120e068672f3' => 'Shufran,KA,Kevin A;Payton,TL,Tracey L Limited genetic variation within and between Russian wheat aphid (Hemiptera: Aphididae) biotypes in the United States. Journal of Economic Entomology 2009-02-01;102(1):440-5',
'b75aec75e24d16bc5ab0a8c5f2937d83' => 'Smith XYZ testest to be deleted Test 1900-01-01;1(1):1-2',
'd8353c52fb29f77007183c00e9e28c17' => 'Soucy,SL,Sheryl L;Danforth,BN,Bryan N Phylogeography of the socially polymorphic sweat bee Halictus rubicundus (Hymenoptera: Halictidae). Evolution 2002-02-01;56(2):330-41',
'e6b2a24909b6b0cbfbc9daf9c523731d' => 'Sperling,FA,F A;Hickey,DA,D A Mitochondrial DNA sequence variation in the spruce budworm species complex (Choristoneura: Lepidoptera). Molecular Biology and Evolution 1994-07-01;11(4):656-65',
'7740d6e328bb727365cf2c45d92203c0' => 'Sperling,FA,F A;Raske,AG,A G;Otvos,IS,I S Mitochondrial DNA sequence variation among populations and host races of Lambdina fiscellaria (Gn.) (Lepidoptera: Geometridae). Insect Molecular Biology 1999-02-01;8(1):97-106',
'19dfb9fb7e4e87c98545600a2df12f15' => 'Spicer,GS,G S;Pitnick,S,S Molecular systematics of the Drosophila hydei subgroup as inferred from mitochondrial DNA sequences. Journal of Molecular Evolution 1996-09-01;43(3):281-6',
'07fb3ee232dddeb1b90c51df462db510' => 'Stevens,J,J;Wall,R,R Genetic relationships between blowflies (Calliphoridae) of forensic importance. Forensic Science International 2001-08-15;120(-1):116-23',
'5fd4c5a921b47ec17a1c3300573c5999' => 'Stevens,JR,J R;Wall,R,R;Wells,JD,J D Paraphyly in Hawaiian hybrid blowfly populations and the evolutionary history of anthropophilic species. Insect Molecular Biology 2002-04-01;11(2):141-8',
'b60692db9394f613e3f57d93a81d9a99' => 'Stevens,MI,Mark I;Hogg,ID,Ian D Long-term isolation and recent range expansion from glacial refugia revealed for the endemic springtail Gomphiocephalus hodgsoni from Victoria Land, Antarctica. Molecular Ecology 2003-09-01;12(9):2357-69',
'207f721ba7fa334fad3809f4d2e0382a' => 'Stireman,JO,John O;Nason,JD,John D;Heard,SB,Stephen B Host-associated genetic differentiation in phytophagous insects: general phenomenon or isolated exceptions? Evidence from a goldenrod-insect community. Evolution 2005-12-01;59(12):2573-87',
'6e65138ad4e8bf19c329cf7a64c5c809' => 'Szymura,JM,J M;Lunt,DH,D H;Hewitt,GM,G M The sequence and structure of the meadow grasshopper (Chorthippus parallelus) mitochondrial srRNA, ND2, COI, COII ATPase8 and 9 tRNA genes. Insect Molecular Biology 1996-05-01;5(2):127-39',
'9a9b4f285f6e5b707de297da5ded503d' => 'Takeda,K,K;Onishi,A,A;Ishida,N,N;Kawakami,K,K;Komatsu,M,M;Inumaru,S,S SSCP analysis of pig mitochondrial DNA D-loop region polymorphism. Animal Genetics 1995-10-01;26(5):321-6',
'7e0c926c788674a1d449b93eac6b96f2' => 'Tan,SH,S H;Mohd Aris,E,E;Kurahashi,H,H;Mohamed,Z,Z A new record of Iranihindia martellata (Senior-White,1924) (Diptera: Sarcophagidae) from peninsular Malaysia and female identification using both morphology and DNA-based approaches. Tropical Biomedicine 2010-08-01;27(2):287-93',
'393645fc055bc3869d6d4c020d9007a4' => 'Tan,SH,Siew Hwa;Aris,EM,Edah Mohd;Surin,J,Johari;Omar,B,Baharudin;Kurahashi,H,Hiromu;Mohamed,Z,Zulqarnain Sequence variation in the cytochrome oxidase subunit I and II genes of two commonly found blow fly species, Chrysomya megacephala (Fabricius) and Chrysomya rufifacies (Macquart) (Diptera: Calliphoridae) in Malaysia. Tropical Biomedicine 2009-08-01;26(2):173-81',
'41c5dae99645bf7d8a54ed1daecd63d4' => 'Tang,B,Boping;Zhou,K,Kaiya;Song,D,Daxiang;Yang,G,Guang;Dai,A,Aiyun Molecular systematics of the Asian mitten crabs, genus Eriocheir (Crustacea: Brachyura). Molecular Phylogenetics and Evolution 2003-11-01;29(2):309-16',
'1e8b2c189a9c0932b81769accd97311a' => 'ten Hagen, Wolfgang; Schurian, Klaus G Polyommatus (Aricia) crassipunctus varicolor ssp. n., eine neue Unterart aus Iran (Lepidoptera: Lycaenidae). Nachrichten des Entomologischen Vereins Apollo 2009-11-01;30(1/2):9-17',
'e9e95e00ba345245d8ff4bbcbff5c4e5' => 'Tornabene, Luke; Baldwin, Carole C; Weigt, Lee A; Pezold, Frank L Exploring the diversity of western Atlantic Bathygobius (Teleostei: Gobiidae) with cytochrome c oxidase-I, with descriptions of two new species. Aqua, International Journal of Ichthyology 2010-10-15;16(4):141-170',
'05e3f8a7e9d19ff67d2fc39c6cfa030c' => 'Uechi,N,N;Tokuda,M,M;Yukawa,J,J;Kawamura,F,F;Teramoto,KK,K K;Harris,KM,K M Confirmation by DNA analysis that Contarinia maculipennis (Diptera: Cecidomyiidae) is a polyphagous pest of orchids and other unrelated cultivated plants. Bulletin of Entomological Research 2003-12-01;93(6):545-51',
'a37c6f56c9e580845adf3292deef5a79' => 'Ursing,BM,B M;Arnason,U,U The complete mitochondrial DNA sequence of the pig (Sus scrofa). Journal of Molecular Evolution 1998-09-01;47(3):302-6',
'be04066ec13b0b78ea95d809bf22ed80' => 'Van Nieukerken, Erik J.; Mutanen, Marko; Doorenweerd, Camiel DNA barcoding resolves species complexes in Stigmella salicis and S. aurella species groups and shows additional cryptic speciation in S. salicis (Lepidoptera: Nepticulidae). Entomologisk Tidskrift 2012-03-01;132(4):235-255',
'19ad8ce3ad6cdad48c6f49e439281175' => 'Vasily GREBENNIKOV Wingless Paocryptorrhinus (coleoptera: curculionidae) rediscovered in tanzania: synonymy, four new species and a mtdnA phylogeography Bonn zoological Bulletin 2015-07-31;64(1):1-15',
'65946b1788513669a30a488ea3d1ef5a' => 'Velzen, Robin Van; Larsen, Torben B; T., Freek A new hidden species of the Cymothoe caenis-complex (Lepidoptera: Nymphalidae) from western Africa Zootaxa 2009-08-13;2197(In Press):53-63',
'fad5016a94487709609a9dc7a1ce6a41' => 'Villesen,P,Palle;Mueller,UG,Ulrich G;Schultz,TR,Ted R;Adams,RM,Rachelle M M;Bouck,AC,Amy C Evolution of ant-cultivar specialization and cultivar switching in Apterostigma fungus-growing ants. Evolution 2004-10-01;58(10):2252-65',
'39cde697e05771af6e62b2a47596e43c' => 'Virgilio,M,M;De Meyer,M,M;White,IM,I M;Backeljau,T,T African Dacus (Diptera: Tephritidae: molecular data and host plant associations do not corroborate morphology based classifications. Molecular Phylogenetics and Evolution 2009-06-01;51(3):531-9',
'36f1fb8a3d3228bd5efc6f8b92757a0c' => 'Wahlberg,N,Niklas;Weingartner,E,Elisabet;Nylin,S,Sören Towards a better understanding of the higher systematics of Nymphalidae (Lepidoptera: Papilionoidea). Molecular Phylogenetics and Evolution 2003-09-01;28(3):473-84',
'8a85502104a7c2cf1c9c0ccd78d8e2a7' => 'Waldbieser,GC,Geoffrey C;Bilodeau,AL,A Lelania;Nonneman,DJ,Dan J Complete sequence and characterization of the channel catfish mitochondrial genome. DNA Sequence 2003-08-01;14(4):265-77',
'fb503dcb06d72524ef4522483f1af989' => 'Ward, Robert D; Holmes, Bronwyn H; Zemlak, Tyler S; Smith, Peter J DNA barcoding discriminates spurdogs of the genus Squalus. In: Descriptions of new dogfishes of the genus Squalus (Squaloidea: Squalidae) CSIRO Marine and Atmospheric Research Paper 2007-01-01;14(12):117-130',
'e6c195d7d184cf8fc0f40f4e6017c321' => 'Wares,JP,J P;Cunningham,CW,C W Phylogeography and historical ecology of the North Atlantic intertidal. Evolution 2001-12-01;55(12):2455-69',
'8d0867fc62894ef7f6d7cc17d9b7c138' => 'Watabiki, Daisuke Yoshimatsu, Shin-ichi Distinguishing the externally similar imagines of Tiracola plagiata and T. aureata whose forewing lengths were shown to overlap (Lepidoptera, Noctuidae) Lepidoptera Science 2013-11-01;64(3):123-127',
'5558c8c64e02f6bf5a24d1998b37901b' => 'Wells,JD,J D;Introna,F,F;Di Vella,G,G;Campobasso,CP,C P;Hayes,J,J;Sperling,FA,F A Human and insect mitochondrial DNA analysis from maggots. Journal of Forensic Sciences 2001-05-01;46(3):685-7',
'330c94ed1ae7b3d4c202f76edf5e0932' => 'Wells,JD,J D;Pape,T,T;Sperling,FA,F A DNA-based identification and molecular systematics of forensically important Sarcophagidae (Diptera). Journal of Forensic Sciences 2001-09-01;46(5):1098-102',
'9beef4c4c6338a40b4363188f07550fe' => 'Wells,JD,J D;Sperling,FA,F A DNA-based identification of forensically important Chrysomyinae (Diptera: Calliphoridae). Forensic Science International 2001-08-15;120(-1):110-5',
'c63980dfafbd39a5f4be5218671af11f' => 'Wells,JD,J D;Sperling,FA,F A Molecular phylogeny of Chrysomya albiceps and C. rufifacies (Diptera: Calliphoridae). Journal of Medical Entomology 1999-05-01;36(3):222-6',
'977eebf7718ebb00f291f77b7d3f5c16' => 'Wilke,T,T;Davis,GM,G M;Gong,X,X;Liu,HX,H X Erhaia (Gastropoda: Rissooidea): phylogenetic relationships and the question of Paragonimus coevolution in Asia. American Journal of Tropical Medicine and Hygiene 2000-04-01;62(4):453-9',
'3a46fbaa4f3aba439b81c3cd4a0ed30a' => 'Williams,ST,S T;Reid,DG,D G;Littlewood,DT,D T J A molecular phylogeny of the Littorininae (Gastropoda: Littorinidae): unequal evolutionary rates, morphological parallelism, and biogeography of the Southern Ocean. Molecular Phylogenetics and Evolution 2003-07-01;28(1):60-86',
'fd67185947ea5751394c4c67a6c765d7' => 'Wowor,D,Daisy;Muthu,V,Victor;Meier,R,Rudolf;Balke,M,Michael;Cai,Y,Yixiong;Ng,PK,Peter K L Evolution of life history traits in Asian freshwater prawns of the genus  Macrobrachium (Crustacea: Decapoda: Palaemonidae) based on multilocus  molecular phylogenetic analysis. Molecular Phylogenetics and Evolution 2009-08-01;52(2):340-50',
'fd5525a539ebf2f2ba27df486fffb636' => 'Yamanoue,Y,Yusuke;Miya,M,Masaki;Inoue,JG,Jun G;Matsuura,K,Keiichi;Nishida,M,Mutsumi The mitochondrial genome of spotted green pufferfish Tetraodon nigroviridis (Teleostei: Tetraodontiformes) and divergence time estimation among model organisms in fishes. Genes and Genetic Systems 2006-02-01;81(1):29-39',
'd0c10ecc0bf5492cf05f718d2fba5dfe' => 'Yong,Z,Zhu;Fournier,PE,Pierre-Edouard;Rydkina,E,Elena;Raoult,D,Didier The geographical segregation of human lice preceded that of Pediculus humanus capitis and Pediculus humanus humanus. Comptes Rendus Biologies 2003-06-01;326(6):565-74',
'e38e0f6d6986048628d47e54a1f76880' => 'Yoo,HS,Hye Sook;Eah,JY,Jae-Yong;Kim,JS,Jong Soo;Kim,YJ,Young-Jun;Min,MS,Mi-Sook;Paek,WK,Woon Kee;Lee,H,Hang;Kim,CB,Chang-Bae DNA barcoding Korean birds. Molecules and Cells 2006-12-31;22(3):323-7',
'9cfe60a76c94c994d34f080e058d0e3d' => 'Yoshimatsu, Shin-ichi Watabiki, Daisuke Nishioka, Toshihiko Nakamura, Hiroaki Yamaguchi, Takuhiro Takesaki, Ken Shimatani, Masayuki Uesato, Takumi Additional information on DNA barcoding of the African armyworm, Spodoptera exempta (Walker) (Lepidoptera, Noctuidae) from Japan Lepidoptera Science 2014-10-01;65(3):89-93',
'3eb71a469c00cbe8fd2a4c2f412403e8' => 'Yukuhiro,K,Kenji;Sezutsu,H,Hideki;Itoh,M,Masanobu;Shimizu,K,Koichi;Banno,Y,Yutaka Significant levels of sequence divergence and gene rearrangements have occurred between the mitochondrial genomes of the wild mulberry silkmoth, Bombyx mandarina, and its close relative, the domesticated silkmoth, Bombyx mori. Molecular Biology and Evolution 2002-08-01;19(8):1385-9',
'2c60d68ace0d139207ce47283d8cb099' => 'Zakharov,EV,Evgueni V;Smith,CR,Campbell R;Lees,DC,David C;Cameron,A,Alison;Vane-Wright,RI,Richard I;Sperling,FA,Felix A H Independent gene phylogenies and morphology demonstrate a malagasy origin for a wide-ranging group of swallowtail butterflies. Evolution 2004-12-01;58(12):2763-82');


foreach ($citations as $guid => $citation)
{
	echo "-- $citation\n";


	$result = crossref_search($citation);
	
	//print_r($result);
	
	$double_check = true;
	$theshhold = 0.8;
	
	if ($double_check)
	{
		// get metadata 
		$query = explode('&', html_entity_decode($result->coins));
		$params = array();
		foreach( $query as $param )
		{
		  list($key, $value) = explode('=', $param);
		  
		  $key = preg_replace('/^\?/', '', urldecode($key));
		  $params[$key][] = trim(urldecode($value));
		}
		
		//print_r($params);
		
		$hit = '';
		if (isset($params['rft.au']))
		{
			$hit = join(",", $params['rft.au']);
		}
		  
		$hit .= ' ' . $params['rft.atitle'][0] 
			. '. ' . $params['rft.jtitle'][0]
			. ' ' . $params['rft.volume'][0]
			. ': ' .  $params['rft.spage'][0];

		$v1 = $citation;
		$v2 = $hit;
		
		echo "-- $hit\n";
		
		//echo "v1: $v1\n";
		//echo "v2: $v2\n";
		

		$v1 = finger_print($v1);
		$v2 = finger_print($v2);					

		if (($v1 != '') && ($v2 != ''))
		{
			//echo "v1: $v1\n";
			//echo "v2: $v2\n";

			$lcs = new LongestCommonSequence($v1, $v2);
			$d = $lcs->score();

			// echo $d;

			$score = min($d / strlen($v1), $d / strlen($v2));

			//echo "score=$score\n";
			
			if ($score > $theshhold)
			{
			
			}
			else
			{
				unset ($result);
			}
		}
	}
	
	
	if ($result)
	{
		echo 'UPDATE `references` SET doi="' . $result->doi . '" WHERE guid="' . $guid . '";' . "\n";
	}
	
	echo "\n\n";

}

?>