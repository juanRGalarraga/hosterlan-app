 export type PublicationState = 'Draft' | 'Published';

export interface Publication {
    id: number;
    title: string;
    price?: number | null;
    ubication: string;
    description?: string | null;
    bathroom_count: number;
    pets: boolean;
    number_people: number;
    user_id: number;
    image_url: string;
    state: PublicationState; 
    rent_type_id: number;
    created_at: string;
    updated_at: string;
}