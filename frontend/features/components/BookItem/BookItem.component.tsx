import Link from 'next/link';
import type { FunctionComponent } from "react";
import type { BookItemProps } from "./BookItem.interface";
import { Card, CardContent, CardMedia, CardActions, Button, Typography, Tooltip } from "@mui/material";

export const BookItem: FunctionComponent<BookItemProps> = ({ title, coverUrl, id }) => {
  return (
    <Card variant="outlined">
      <CardMedia sx={{ height: 264 }} image={coverUrl ? coverUrl : "/cover.png"} title={title} />
      <CardContent>
        <Tooltip title={title} arrow>
          <Typography gutterBottom variant="h5" noWrap>
            {title}
          </Typography>
        </Tooltip>
        <Typography variant="body2" color="text.secondary">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam non arcu...
        </Typography>
      </CardContent>
      <CardActions>
        <Button size="small" variant="contained" fullWidth>
        <Link href={`/form/${id}`}>
          Empréstimo
        </Link>
        </Button>
      </CardActions>
    </Card>
  );
};
