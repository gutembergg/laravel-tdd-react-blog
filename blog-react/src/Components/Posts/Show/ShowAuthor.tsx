interface ShowNameProps {
    name: string;
}

function ShowAuthor({ name }: ShowNameProps) {
    return <span>{name}</span>;
}

export default ShowAuthor;
