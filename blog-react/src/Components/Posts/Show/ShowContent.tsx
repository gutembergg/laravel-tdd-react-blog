interface ShowContentProps {
    content: string;
}

function ShowContent({ content }: ShowContentProps) {
    return <p className="text-center">{content}</p>;
}

export default ShowContent;
