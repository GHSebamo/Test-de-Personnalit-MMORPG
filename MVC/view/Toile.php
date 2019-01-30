<div id=canv>
<div id="containerToile"><canvas id="toile"></canvas></div>
<div id=horiz>
<div id="containerBarre"><canvas id="barre"></canvas></div>
<div id="containerTroll"><canvas id="troll"></canvas></div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>

var util_champion= '<?php echo $resultat->getResChampion()?>';
var util_coach= '<?php echo $resultat->getResCoach()?>';
var util_leader= '<?php echo $resultat->getResLeader()?>';
var util_mercenaire= '<?php echo $resultat->getResMercenaire()?>';
var util_officier= '<?php echo $resultat->getResOfficier()?>';
var util_solitaire= '<?php echo $resultat->getResSolitaire()?>';
var util_collaborateur= '<?php echo $resultat->getResCollaborateur()?>';
var util_membre= '<?php echo $resultat->getResMembre()?>';
var moy_champion= '<?php echo $res_moy->getResChampion()?>';
var moy_coach= '<?php echo $res_moy->getResCoach()?>';
var moy_leader= '<?php echo $res_moy->getResLeader()?>';
var moy_mercenaire= '<?php echo $res_moy->getResMercenaire()?>';
var moy_officier= '<?php echo $res_moy->getResOfficier()?>';
var moy_solitaire= '<?php echo $res_moy->getResSolitaire()?>';
var moy_collaborateur= '<?php echo $res_moy->getResCollaborateur()?>';
var moy_membre= '<?php echo $res_moy->getResMembre()?>';

var util_troll = '<?php echo $resultat->getResTroll()?>';
var moy_troll= '<?php echo $res_moy->getResTroll()?>'

var ctxToile = document.getElementById("toile").getContext('2d');
var ctxBarre = document.getElementById("barre").getContext('2d');
var ctxTroll = document.getElementById("troll").getContext('2d');

var toile = new Chart(ctxToile, {
    type: 'radar',
    data: {
        labels: ["Champion", "Coach", "Leader", "Mercenaire", "Officier", "Solitaire", "Collaborateur", "Membre"],
        datasets:[
            {
                label: 'Vos résultats',
                data: [util_champion, util_coach, util_leader, util_mercenaire, util_officier, util_solitaire, util_collaborateur, util_membre],
                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                borderColor: 'rgba(66, 134, 244, 1)',
                borderWidth: 1
            },
            {
                label: 'Moyenne',
                data: [moy_champion, moy_coach, moy_leader, moy_mercenaire, moy_officier, moy_solitaire, moy_collaborateur, moy_membre],
                backgroundColor: 'rgba(244, 66, 66, 0)',
                borderColor: 'rgba(244, 66, 66, 1)',
                borderWidth: 1
            },{
                label: '',
                data: [100,0],
                backgroundColor: 'rgba(255,255,255,0)',
                borderColor: 'rgba(255, 255, 255, 0)',
                borderWidth: 1
            }
        ]
    }
});

var barre = new Chart(ctxBarre, {
    type: 'horizontalBar',
    data: {
        labels: ["Champion", "Coach", "Leader", "Mercenaire", "Officier", "Solitaire", "Collaborateur", "Membre"],
        datasets:[
            {
                label: 'Vos résultats',
                data: [util_champion, util_coach, util_leader, util_mercenaire, util_officier, util_solitaire, util_collaborateur, util_membre],
                backgroundColor: 'rgba(66, 134, 244, 0.2)',
                borderColor: 'rgba(66, 134, 244, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
                responsive: true,
                title: {
                    display: true,
                    text: ''
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            min: 0,
                            max: 100
                        }
                    }]
                }
            }
});

var troll = new Chart(ctxTroll, {
    type: 'horizontalBar',
    data: {
        labels: ["Votre résultat", "Moyenne"],
        datasets: [{
            label: 'Tendance au troll',
            data: [util_troll, moy_troll],
            backgroundColor: [
                'rgba(66, 134, 244, 0.2)',
                'rgba(244, 66, 66, 0.2)'
            ],
            borderColor: [
                'rgba(66, 134, 244, 1)',
                'rgba(244, 66, 66, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
                responsive: true,
                title: {
                    display: true,
                    text: ''
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            min: 0,
                            max: 100
                        }
                    }]
                }
            }
});
</script>