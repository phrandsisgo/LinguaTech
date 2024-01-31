<button {{ $attributes->merge(['type' => 'submit', 'class' => ' standartDangerButton']) }}>
    {{ $slot }}
</button>
