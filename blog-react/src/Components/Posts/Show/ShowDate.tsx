import { HTMLAttributes } from 'react';

interface ShowDateProps extends HTMLAttributes<HTMLHeadingElement> {
    date: string;
}

function ShowDate({ date, ...rest }: ShowDateProps) {
    return <span {...rest}>{date}</span>;
}

export default ShowDate;
