import './styles.css';

interface ShowPostImageProps {
    path: string;
    name: string;
}

function ShowImage({ path, name }: ShowPostImageProps) {
    return (
        <div className="postHeader__image">
            <img className="w-full object-cover" data-testid="postHeader" src={path} alt={name} />
        </div>
    );
}

export default ShowImage;
