
export interface User { 
    id: number;
    name: string;
    role: 'owner' | 'guest';
    email: string;
}