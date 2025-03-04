<?php
$title = get_field('title');
$image = get_field('image');
$number = get_field('number');
$style = strtolower(get_field('style'));
$block_id = 'counter-' . uniqid(); // Generar un identificador único

// Verificar y asignar la clase CSS correcta
$valid_styles = ['black' => 'style-black', 'gray' => 'style-gray', 'gris' => 'style-gray']; 
$style_class = isset($valid_styles[$style]) ? $valid_styles[$style] : '';// Si el valor es válido, asignar la clase correcta
?>

<div class="info-number-counter <?php echo esc_attr($style_class); ?>">
    <?php if ($image): ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    <?php endif; ?>
    <span class="h3 info-number-counter--number" id="<?php echo esc_attr($block_id); ?>" data-target="<?php echo esc_attr($number); ?>">+0</span>
    <span class="h5 info-number-counter--text"><?php echo esc_html($title); ?></span>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let counter = document.getElementById("<?php echo esc_attr($block_id); ?>");
    let targetNumber = parseInt(counter.getAttribute("data-target"));
    
    let start = 0;
    let speed = Math.floor(targetNumber / 50); // Ajusta la velocidad de la animación
    
    function updateCounter() {
        start += speed;
        if (start >= targetNumber) {
            counter.innerText = '+' + targetNumber;
        } else {
            counter.innerText = '+' + start;
            requestAnimationFrame(updateCounter);
        }
    }
    
    updateCounter();
});
</script>

