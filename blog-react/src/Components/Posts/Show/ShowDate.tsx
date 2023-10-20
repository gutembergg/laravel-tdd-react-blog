interface ShowDateProps {
    date: string;
}

function ShowDate({ date }: ShowDateProps) {
    return <span>{date}</span>;
}

export default ShowDate;
