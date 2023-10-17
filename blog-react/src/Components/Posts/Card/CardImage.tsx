interface CardImageProps {
    path: string;
    name: string;
}

function CardImage({ path, name }: CardImageProps) {
    return <img className="w-full min-h-[300px] rounded-t-lg object-cover" src={path} alt={name} />;
}

export default CardImage;
