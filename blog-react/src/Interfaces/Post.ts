type Category = {
    id: number;
    name: string;
};

export interface Post {
    id: number;
    title: string;
    content: string;
    categories?: Category[];
    medias?: string[];
}
