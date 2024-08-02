<x-base-layout title="Nous contacter">

    <x-container class="py-12">
        <h2 class="text-base font-medium text-muted-foreground mb-3">
            Nous contacter
        </h2>
        <p class="text-sm text-muted-foreground max-w-lg">
            Nous sommes ravis de vous accueillir sur notre page de contact. Que vous ayez des questions, des suggestions ou besoin d'assistance, notre équipe est là pour vous aider. N'hésitez pas à nous contacter en utilisant les informations ci-dessous ou en remplissant le formulaire de contact.
        </p>

        <div class="mt-5 max-w-lg">
            <div class="mb-4">
                <h2 class="text-base font-medium text-muted-foreground mb-3">
                    Formulaire de contact
                </h2>
            <p class="text-sm text-muted-foreground max-w-lg">
                    Si vous préférez nous envoyer un message directement, veuillez remplir le formulaire ci-dessous. Nous nous efforcerons de vous répondre dans les plus brefs délais.
                </p>
            </div>
            @include('contact.form')
        </div>
    </x-container>
</x-base-layout>
