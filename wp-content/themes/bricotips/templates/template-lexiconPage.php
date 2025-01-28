<?php

/**
 * Template Name: Lexicon Page Template
 * Template Post Type: page
 */

$lexiconWords = [
    [
        "title" => "Abattant",
        "definition" => "Châssis de fenêtre s’ouvrant horizontalement."
    ],
    [
        "title" => "Apprêt",
        "definition" => "Couche de peinture ou de papier peint posé sur un mur pour en améliorer l’aspect final."
    ],
    [
        "title" => "Béton",
        "definition" => "Agrégat de sable, de ciment et d’eau. Armé, il est coulé sur armature métallique. Cellulaire, il comporte des milliers de bulles qui lui confèrent une très bonne isolation et solidité."
    ],
    [
        "title" => "Chaume",
        "definition" => "Matériau de couverture fait de paille de seigle, de roseau, etc."
    ],
    [
        "title" => "Drain",
        "definition" => "Dispositif enterré destiné à capter les eaux souterraines."
    ],
    [
        "title" => "Entrait",
        "definition" => "Pièce de charpente horizontale joignant les arbalétriers."
    ],
    [
        "title" => "Greffer",
        "definition" => "Remplacer la partie endommagée d’une pièce de bois par un matériau sain."
    ],
    [
        "title" => "Lambourde",
        "definition" => "Poutre fixée le long d’un mur pour recevoir des solives sur lesquelles sont clouées les lames d’un parquet."
    ],
    [
        "title" => "Mortaise",
        "definition" => "Entaille faite dans une pièce de bois pour recevoir le tenon d’une autre pièce."
    ]
];

get_header();
?>

<main id="lexicon">
    <?= do_shortcode('[banner-title title="Lexique du bricolage" src="/wp-content/uploads/2025/01/banniere-image.webp"]'); ?>

    <section>
        <?php

        foreach ($lexiconWords as $word) {
            get_template_part('template-parts/collapsible-block', null, $word);
        }
        ?>
    </section>

</main><!-- #site-content -->

<script>
    const words = document.querySelectorAll("#lexicon .word");
    words.forEach(word => {
        word.addEventListener("click", (e) => {
            if (!word.classList.contains("open")) {
                words.forEach(w => {
                    w.classList.remove("open");
                })
                word.classList.add("open");
            } else word.classList.remove("open");
        })
    })
</script>

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
