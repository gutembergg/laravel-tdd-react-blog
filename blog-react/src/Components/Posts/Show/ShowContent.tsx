interface ShowContentProps {
    content: string;
}

function ShowContent({ content }: ShowContentProps) {
    return <p className="max-w-[80%]">{content}</p>;
}

export default ShowContent;
