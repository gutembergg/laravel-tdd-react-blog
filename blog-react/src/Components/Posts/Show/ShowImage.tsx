interface ShowPostImageProps {
    path: string;
    name: string;
}

function ShowImage({ path, name }: ShowPostImageProps) {
    return <img className="min-w-[700px] min-h-[400px] max-w-[700px] object-cover" src={path} alt={name} />;
}

export default ShowImage;
