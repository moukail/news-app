import React from 'react';
import {CircularProgress, Grid} from "@mui/material";

const LoadingView = () => {
    return (
        <Grid
            container
            spacing={0}
            direction="column"
            alignItems="center"
            justify="center"
            style={{ minHeight: '100vh' }}
        >
            <Grid item xs={3}>
                <CircularProgress />
            </Grid>
        </Grid>
    );
};

export default LoadingView;