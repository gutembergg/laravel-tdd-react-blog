interface ShowPostImageProps {
    path: string;
}

function ShowImage({ path }: ShowPostImageProps) {
    return <img src={path} alt="" />;
}

export default ShowImage;
