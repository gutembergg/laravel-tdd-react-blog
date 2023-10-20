interface ShowTitleProps {
    title: string;
}

function ShowTitle({ title }: ShowTitleProps) {
    return <h1 className="font-semibold text-2xl">{title}</h1>;
}

export default ShowTitle;
