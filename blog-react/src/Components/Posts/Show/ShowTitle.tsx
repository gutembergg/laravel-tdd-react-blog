interface ShowTitleProps {
    title: string;
}

function ShowTitle({ title }: ShowTitleProps) {
    return <h1>{title}</h1>;
}

export default ShowTitle;
