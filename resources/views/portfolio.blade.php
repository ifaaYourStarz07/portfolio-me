<x-layouts.app :profile="$profile" :social-links="$socialLinks">
    <!-- Hero Section -->
    <x-hero :profile="$profile" />

    <!-- About Me Section -->
    <x-about :profile="$profile" />

    <!-- Selected Works / Projects Showcase -->
    <x-projects :projects="$projects" />

    <!-- Skills & Capabilities -->
    <x-skills :skills="$skills" />

    <!-- Learning Journey & Milestones -->
    <x-journey :journey="$learningJourney" />

    <!-- Contact & Connect -->
    <x-contact :profile="$profile" :social-links="$socialLinks" />
</x-layouts.app>
