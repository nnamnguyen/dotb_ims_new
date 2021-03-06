<?php



class DotbJobKBContentUpdateArticles implements RunnableSchedulerJob
{

    /**
     * @var $job Job object.
     */
    protected $job;

    /**
     * @var TimeDate $td
     */
    protected $td;

    /**
     * Sets the SchedulersJob instance for the class.
     *
     * @param SchedulersJob $job
     */
    public function setJob(SchedulersJob $job)
    {
        $this->job = $job;
    }

    /**
     * Handles processing SchedulersJobs.
     *
     * @param Mixed $data Passed in from the job_queue.
     * @return bool True on success, false on error.
     */
    public function run($data)
    {
        $this->td = new TimeDate();

        // Expired articles.
        foreach ($this->getExpiredArticles() as $article) {
            $bean = BeanFactory::getBean('KBContents', $article['id']);
            $bean->exp_date = $this->td->nowDate();
            $bean->status = KBContent::ST_EXPIRED;
            $bean->save();
        }

        // Approved articles.
        foreach ($this->getApprovedArticles() as $article) {
            $bean = BeanFactory::getBean('KBContents', $article['id']);

            if ($bean->active_date) {
                if ($bean->exp_date && strtotime($bean->exp_date) <= strtotime($this->td->nowDate())) {
                    $bean->exp_date = $this->td->nowDate();
                    $bean->status = KBContent::ST_EXPIRED;
                } else {
                    $bean->status = KBContent::ST_PUBLISHED;
                }
                $bean->active_date = $this->td->nowDate();
                $bean->save();
            }
        }
        return $this->job->succeedJob();
    }

    /**
     * Returns expired articles.
     *
     * @return array Of IDs.
     */
    protected function getExpiredArticles()
    {
        $sq = new DotbQuery();
        $sq->select(array('id'));
        $sq->from(BeanFactory::newBean('KBContents'));
        $sq->where()
            ->in('status', KBContent::getPublishedStatuses())
            ->lte('exp_date', $this->td->nowDbDate());
        return $sq->execute();
    }

    /**
     * Returns approved articles.
     *
     * @return array Of IDs.
     */
    protected function getApprovedArticles()
    {
        $sq = new DotbQuery();
        $sq->select(array('id'));
        $sq->from(BeanFactory::newBean('KBContents'));
        $sq->where()
            ->equals('status', KBContent::ST_APPROVED)
            ->lte('active_date', $this->td->nowDbDate());
        return $sq->execute();
    }
}
