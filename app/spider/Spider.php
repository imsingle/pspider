<?php
/**
 * 流程控制
 * Date: 17/1/24
 * Time: 下午12:59
 */

class Spider implements Task{
    protected $download = null;

    protected $processor = null;

    protected $scheduler = null;

    protected $site = null;

    private $uuid = null;

    public function run() {

    }

    public function addRequest(Request $request) {
        if (empty($this->site->getDomain()) && $request && $request->getUrl()) {
            $this->site->setDomain(getDomainByUrl($request->getUrl()));
        }
        $this->sechduler->push($this, $request);
    }

    public function setDownload() {

    }

    public function setScheduler(SchedulerInterface $scheduler):Spider {
        $this->checkRunning();
        $oldScheduler = $this->scheduler;
        $this->scheduler = $scheduler;
        if ($oldScheduler->getLeftRequestCount()) {
            $request = null;
            while ($request = $oldScheduler->poll()) {
                $this->scheduler->push($this, $request);
            }
        }
        return $this;
    }

    protected function checkRunning() {

    }

    public function getUUID():string {
        if ($this->uuid) {
            return $this->uuid;
        }

        if ($this->site) {
            $this->site->getDomain();
        }

        return base64_encode(microtime());
    }

    public function setUUID(string $uuid) {
        $this->uuid = $uuid;
    }

    public function setSite(Site $site) {
        $this->site = $site;
    }
}