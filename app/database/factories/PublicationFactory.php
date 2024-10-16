<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RentType;
use App\Models\User;
use App\Enums\Publication\StateEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->randomElement($this->titles()),
            'price'=>fake()->numberBetween(3000.00, 100000.00),
            'ubication'=> fake()->randomElement($this->addresses()),
            'description'=>fake()->randomElement($this->descriptions()),
            'room_count'=>fake()->numberBetween(1,10),
            'bathroom_count'=>fake()->numberBetween(1,10),
            'pets'=>fake()->boolean(),
            'number_people'=> fake()->numberBetween(1,10),
            'rent_type_id' => RentType::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'state' => StateEnum::Published->name
        ];
    }

    public function descriptions(): array{
        return [
            "Departamento de 2 habitaciones con balcón, ubicado en una zona tranquila. Ideal para parejas o estudiantes. Cercano a parques y transporte público. ¡Listo para mudarse!",
            "Acogedor monoambiente en pleno centro de Gualeguaychú. Perfecto para quienes buscan comodidad y cercanía a todos los servicios: tiendas, restaurantes y centros culturales a solo pasos de distancia.",
            "Moderno departamento de 3 habitaciones con cocina equipada y amplio living. A solo minutos de las principales avenidas y con fácil acceso a transporte público. ¡No pierdas la oportunidad!",
            "Lindo departamento de 1 dormitorio, completamente amoblado y con decoración moderna. Incluye cochera y servicios de seguridad las 24 horas. ¡Ideal para profesionales o parejas!",
            "Casa de 3 dormitorios en un barrio residencial exclusivo. Con jardín privado, parrilla y amplio garaje. Perfecto para familias que buscan tranquilidad y espacio.",
            "Departamento de 2 habitaciones a precio accesible, con cocina y baño completamente renovados. Cerca de colegios, supermercados y áreas recreativas. ¡Ideal para estudiantes o jóvenes profesionales!",
            "Amplio departamento de 2 dormitorios con vista panorámica. Equipado con aire acondicionado y espacios luminosos. En edificio moderno con gimnasio y piscina.",
            "Monoambiente en edificio de categoría, ubicado a pocos metros del centro comercial. Con cocina integrada, amplio placard y balcón. Ideal para quienes buscan practicidad.",
            "Hermosa casa de 4 ambientes con patio y parrilla. En un barrio muy tranquilo y familiar, con rápido acceso al centro de la ciudad. ¡Perfecta para familias que disfrutan del aire libre!",
            "Casa de dos pisos con 4 habitaciones, 3 baños y amplio jardín. Cocina moderna y cochera doble. Barrio seguro y muy bien ubicado, cerca de escuelas y centros comerciales.",
        ];
    }

    public function addresses(): array{
        return [
            "San Martín 1234",
            "Urquiza 567",
            "Bolívar 890",
            "Belgrano 250",
            "25 de Mayo 1400",
            "Montevideo 360",
            "Moreno 1100",
            "3 de Febrero 800",
            "España 450",
            "Rivadavia 990",
            "Mitre 720",
            "Sarmiento 1030",
            "Alem 270",
            "Artigas 540",
            "Gervasio Méndez 880",
            "Luis N. Palma 610",
            "Perón 850",
            "San Lorenzo 980",
            "Clavarino 520",
            "Victoria 1050",
            "Primera Junta 740",
            "Fray Mocho 630",
            "Ituzaingó 540",
            "Pablo Grané 930",
            "Estrada 410",
            "Jujuy 580",
            "Alberdi 470",
            "Francia 820",
            "Buenos Aires 1000",
            "Maipú 340",
        ];
    }

    public function titles() : array {
        return [
            "¡Tu próximo hogar te espera! Descubre este increíble alquiler disponible ahora",
            "Vive en el corazón de la ciudad Alquiler ideal para ti",
            "Apartamentos de ensueño listos para mudarse ¿Quieres verlo?",
            "Espacios cómodos y modernos, listos para ti! ¡No lo dejes escapar!",
            "Encuentra tu lugar perfecto Alquileres disponibles en las mejores zonas",
            "Tu nuevo hogar está aquí ¡Alquiler accesible y conveniente!",
            "Vive como siempre has querido Departamentos disponibles para alquiler",
            "Céntrico, cómodo y perfecto para ti ¿Buscas un nuevo lugar?",
            "Haz realidad tu vida ideal Alquila ahora en las mejores ubicaciones",
            "La casa de tus sueños te está esperando ¡No te lo pierdas!",
        ];
    }
}
